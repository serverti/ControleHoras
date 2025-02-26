<?php

namespace App\Controller\Admin;

use App\Entity\BancoHoras;
use App\Entity\QRCode; // Certifique-se de importar o QRCode
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Renderiza o dashboard
        return $this->render('banco_horas/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Controle de Horas')
            ->setLocales(['pt_BR', 'pt', 'en']);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Banco de Horas', 'fas fa-clock', BancoHoras::class);
        yield MenuItem::linkToCrud('QR Codes', 'fas fa-qrcode', QRCode::class);
    }
}
