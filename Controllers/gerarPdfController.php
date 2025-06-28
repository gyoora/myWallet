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
                $mpdf = new \Mpdf\mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'L'
                ]);

                $mpdf->WriteHTML($conteudoPagina);

                $mpdf->Output('dashboard.pdf', 'I');

                header("Location: /dashboard");
                exit();
            } catch (Exception $e) {
                echo "Erro ao gerar o PDF: " . $e->getMessage();
            }
        }
    }
    ?>
