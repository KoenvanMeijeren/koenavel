<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Actions;

use App\Http\Domain\Repositories\PageRepository;
use App\Http\Domain\Repositories\SlugRepository;
use App\Models\Admin\Page;
use App\Models\Admin\Slug;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

abstract class PageAction extends FormAction
{
    protected Page $page;
    protected PageRepository $pageRepository;
    protected Session $session;

    protected int $id;
    protected string $title;
    protected int $slugId;
    protected string $url;
    protected int $inMenu;
    protected string $content;

    public function __construct(Page $page)
    {
        $this->page = $page;
        $slug = new Slug();
        $this->session = new Session();
        $request = new Request();

        $this->title = $request->post('title');
        $this->url = $slug->parse($request->post('slug'));
        $this->inMenu = (int)$request->post('pageInMenu');
        $this->content = $request->post('content');

        $slugRepository = new SlugRepository(
            $slug->firstOrCreate([
                'slug_name' => $this->url
            ])
        );

        $this->slugId = $slugRepository->getId();

        $this->pageRepository = new PageRepository(
            $this->page->getBySlug($slugRepository->getSlug())
        );
        $this->id = $this->pageRepository->getId();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->title)
            ->isRequired();

        if ($this->url !== $this->pageRepository->getSlug()) {
            $validator->input($this->url)
                ->isRequired()
                ->isUnique(
                    $this->page->getBySlug($this->url),
                    sprintf(
                        Translation::get('page_already_exists'),
                        $this->url
                    )
                );
        }

        $validator->input((string)$this->inMenu)
            ->isRequired()
            ->isBetweenRange(
                Page::PAGE_NOT_IN_MENU,
                Page::PAGE_IN_MENU_AND_IN_FOOTER
            );

        $validator->input($this->content)
            ->isRequired();

        return $validator->handleFormValidation();
    }
}
