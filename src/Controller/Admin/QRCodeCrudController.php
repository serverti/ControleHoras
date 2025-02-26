<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use App\Entity\QRCode;  // Certifique-se de importar a entidade QRCode

class QRCodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QRCode::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nome'),
            ChoiceField::new('tipo')->setChoices([
                'Tipo 1' => 'tipo1',
                'Tipo 2' => 'tipo2',
                // Adicione mais opções de tipo conforme necessário
            ]),
            TextEditorField::new('conteudo'),
            TextField::new('acao'),
            BooleanField::new('status'),
            ImageField::new('conteudo')  // Para mostrar a imagem do QR Code na listagem
                ->setBasePath('/uploads/qrcodes')  // Caminho onde as imagens de QR Code serão armazenadas
                ->onlyOnIndex(),
        ];
    }

    // Função que gera o QR Code e salva no diretório de uploads
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof QRCode) {
            // Apenas atualiza o conteúdo sem gerar o QR Code por enquanto
            // Não geramos nem salvamos a imagem do QR Code
            // Você pode adicionar um log ou qualquer outra ação que deseje realizar aqui
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
