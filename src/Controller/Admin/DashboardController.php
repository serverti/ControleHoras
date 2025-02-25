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
        // Defina o título do seu painel administrativo
        return Dashboard::new()
            ->setTitle('Controle de Horas');
    }

    public function configureMenuItems(): iterable
    {
        // Menu de navegação
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Banco de Horas', 'fas fa-clock', BancoHoras::class);
        // Adicione o item de menu para o QRCode
        yield MenuItem::linkToCrud('QR Codes', 'fas fa-qrcode', QRCode::class);
    }
}
