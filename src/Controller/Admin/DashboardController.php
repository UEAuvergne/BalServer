<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Bal;
use App\Entity\Book;
use App\Entity\BookInstance;
use App\Entity\Owner;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    function __construct(
        public TranslatorInterface $translator
    )
    {

    }

    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Balserver');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section($this->translator->trans('bal.bal'));
        yield MenuItem::linkToCrud($this->translator->trans('bal.bals'), 'fa fa-tags', Bal::class);
        yield MenuItem::linkToCrud($this->translator->trans('bal.book_instances'), 'fa fa-book', BookInstance::class);
        yield MenuItem::linkToCrud($this->translator->trans('bal.book_data'), 'fa fa-file-text', Book::class);
        yield MenuItem::linkToCrud($this->translator->trans('bal.owners'), 'fa fa-user-o', Owner::class);

        yield MenuItem::section($this->translator->trans('users'));
        yield MenuItem::linkToCrud($this->translator->trans('users'), 'fa fa-users', User::class);
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud($this->translator->trans('admins'), 'fa fa-user', Admin::class);
        }
    }
}
