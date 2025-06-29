<?php
require_once "vendor/autoload.php";
class GerarPdfController {

    public function gerarPdf() {
        $conteudoPagina = $_POST['conteudo'] ?? '';

        if (empty($conteudoPagina)) {
            header("Location: /dashboard");
            exit();
        }

        try {

            $dompdf = new Dompdf\Dompdf();
            $dompdf->loadHtml($conteudoPagina);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            ob_end_clean();
            $dompdf->stream("dashboard.pdf", ["Attachment" => true]);
            exit();
        } catch (Exception $e) {
            echo "Erro ao gerar o PDF: " . $e->getMessage();
        }
    }
}
?>
