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
        $omzetexcel = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("Inkoopprijzen.xlsx")->load("Inkoopprijzen.xlsx");

        $voorraad = $omzetexcel->getActiveSheet()->getHighestRow() - 11;

        $this->RemoveStock();

        return $this->render('dashboard.html.twig', [
            'voorraad' => $voorraad,
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
            ->add('Inruil', TextType::class, ['label' => 'Inruil'])
            ->add('Inruilprijs', MoneyType::class, ['label' => 'Inruilprijs'])
            ->add('subtotaal', MoneyType::class, ['label' => 'Sub-totaal'])
            ->add('totaal', MoneyType::class, ['label' => 'Totaal'])
            ->add('opmerking', MoneyType::class, ['label' => 'Opmerking'])
            ->add('Inruillicense', MoneyType::class, ['label' => 'Kenteken inruiler'])
            ->add('verkochteauto', MoneyType::class, ['label' => 'Verkochte auto'])
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

        $templateProcessor->setValue('invoicenumber', $invoice->getInvoiceNumber());
        $templateProcessor->setValue('factuurdatum', $invoice->getInvoicedate());
        $templateProcessor->setValue('inruilprijs', $invoice->getInruilprijs());
        $templateProcessor->setValue('name', $invoice->getName());
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
        $templateProcessor->setValue('subtotaal', $invoice->getSubtotaal());
        $templateProcessor->setValue('factuurdatum', $invoice->getInvoicedate());
        $templateProcessor->setValue('opmerking', $invoice->getOpmerking());
        $templateProcessor->setValue('Inruillicense', $invoice->getInruillicense());
        $templateProcessor->setValue('verkochteauto', $invoice->getVerkochteauto());
        $templateProcessor->setValue('license', $invoice->getLicense());

        $templateProcessor->saveAs('test3.docx');

        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor , 'PDF');
        $xmlWriter->save('result.pdf'); 
        
        if($this->RemoveStock($invoice)) {
            echo "<script>alert('De factuur is aangemaakt, en de voorraad is bijgewerkt!');</script>";
        }
    }

    public function RemoveStock() {

        $license = 'PK-493-N';

        $column = 'B';

        $omzetexcel = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("Inkoopprijzen.xlsx")->load("Inkoopprijzen.xlsx");

        $data = $omzetexcel->getActiveSheet();

        $lastRow = $data->getHighestRow();

        for ($row = 1; $row <= $lastRow; $row++) {

            $cell = $data->getCell($column.$row)->GetValue();

            if ($cell == $license)
                $data->removeRow($row);
        }

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($omzetexcel);
        // $writer->save('Inkoopprijzentest.xlsx');

        //$templateProcessor = new \PhpOffice\PhpWord('Factuur.docx');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        \PhpOffice\PhpWord\Settings::setPdfRendererPath('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        
        $document = $phpWord->loadTemplate('Factuur.docx');
        $document->saveAs('Factuur.docx');
        $phpWord = \PhpOffice\PhpWord\IOFactory::load('Factuur.docx');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'PDF');
        $xmlWriter->save('Factuur.docx');  // Save to PDF
        unlink($temDoc);

        return true;
    }

}