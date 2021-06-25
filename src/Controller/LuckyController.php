<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

use App\Entity\Invoice;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class LuckyController extends AbstractController
{
    
    /**
        * @Route("home", name="home_page")
    */
    public function dashboard(Request $request) : Response
    {
        //$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("omzet.xlsx");
        //$reader->setReadDataOnly(true);
        //$reader->load("omzet.xlsx");

        // $highestRow = $objWorksheet->getHighestRow();
        // $highestColumn = $objWorksheet->getHighestColumn();
        // $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);


        // for($row=1; $row < $highestRow; ++$row){
        //     $value = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();

        //     if (strpos($value, $kenteken) !== false) {
        //         $objPHPExcel->getActiveSheet()->removeRow($row, $row);
        //     }
        // }

        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        // $objWriter->save($path);

        return $this->render('dashboard.html.twig', [
            //'form' => $form->createView(),
        ]);
    }


    /**
        * @Route("/maak-factuur")
    */
    public function SubmitInvoice(Request $request) : Response
    {
        $invoice = new Invoice();

        $form = $this->createFormBuilder($invoice)
            ->add('invoicenumber', NumberType::class, ['label' => 'Factuur nummer'])
            ->add('invoicedate', DateType::class, ['label' => 'Factuur datum'])
            ->add('name', TextType::class, ['label' => 'Naam'])
            ->add('street', TextType::class, ['label' => 'Straat'])
            ->add('streetnumber', NumberType::class, ['label' => 'Huisnummer'])
            ->add('city', TextType::class, ['label' => 'Plaats'])
            ->add('postcode', TextType::class, ['label' => 'Postcode'])
            ->add('telefoonnummer', NumberType::class, ['label' => 'Telefoon nummer'])
            ->add('email', TextType::class, ['label' => 'E-mail'])
            ->add('license', TextType::class, ['label' => 'Kenteken'])
            ->add('meldcode', NumberType::class, ['label' => 'Meldcode'])
            ->add('Garantie', TextType::class, ['label' => 'Garantie'])
            ->add('Afleveringsbeurt', TextType::class, ['label' => 'Afleveringsbeurt'])
            ->add('Inruil', TextType::class, ['label' => 'Kenteken'])
            ->add('Inruilprijs', MoneyType::class, ['label' => 'Kenteken'])
            ->add('subtotaal', MoneyType::class, ['label' => 'Kenteken'])
            ->add('save', SubmitType::class, ['label' => 'Maak factuur'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            $this->GenerateInvoice($data);
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function GenerateInvoice(Invoice $invoice) {

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Factuur.docx');

        $templateProcessor->setValue('name', $invoice->getName())->setValue('street', $invoice->getStreet());
        $templateProcessor->setValue('street', $invoice->getStreet());
        $templateProcessor->setValue('number', $invoice->getStreetNumber());
        $templateProcessor->setValue('city', $invoice->getCity());
        $templateProcessor->setValue('postcode', $invoice->getPostcode());
        $templateProcessor->setValue('telefoonnummer', $invoice->getTelefoonnummer());
        $templateProcessor->setValue('email', $invoice->getEmail());
        $templateProcessor->setValue('meldcode', $invoice->getMeldcode());
        $templateProcessor->setValue('garantie', $invoice->getGarantie());
        $templateProcessor->setValue('afleveringsbeurt', $invoice->getAfleveringsbeurt());
        $templateProcessor->setValue('Inruil', $invoice->getInruil());
        $templateProcessor->setValue('totaal', $invoice->getTotaal());
        $templateProcessor->setValue('factuurdatum', $invoice->getInvoicedate());
        $templateProcessor->setValue('opmerking', $invoice->getOpmerking());
        $templateProcessor->setValue('license', $invoice->getLicense());

        $templateProcessor->saveAs('test3.docx');
    }

}