<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Invoicelines;
use App\Form\InvoiceFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
//        Setting the TVA
        $TVA = 10;
//        Create invoice variable
        $invoice = new Invoice();
//        Create invoiceline variable
        $line = new Invoicelines();
//        Add invoiceline in invoice
        $invoice->getInvoicelines()->add($line);
//        Create invoice form with invoiceline inside
        $form = $this->createForm(InvoiceFormType::class, $invoice);
//        Submitting the form
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $lines = $invoice->getInvoicelines();

            $last_id_record = $em->getRepository(Invoice::class)->findOneBy(['id' => 'desc']);
            $invoice->setInvoiceNumber($last_id_record ? (int)$last_id_record->getId() + 1 : 1);
            $em->persist($invoice);

//            Persisting invoice lines into the invoice we are creating
            foreach ($lines as $singleLine) {
                $amount = $singleLine->getQuantity() * $singleLine->getAmount();
                $vat = ($amount * $TVA) / 100;
                $total_amount = $amount + $vat;

                $singleLine
                    ->setVATAmount($vat)
                    ->setTotal($total_amount)
                    ->setInvoice($invoice)
                ;
                $em->persist($singleLine);
            }

            $em->flush();
            unset($form);
            unset($invoice);
            unset($line);

            $invoice = new Invoice();
            $line = new Invoicelines();
            $invoice->getInvoicelines()->add($line);
            $form = $this->createForm(InvoiceFormType::class, $invoice);
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
