<?php

    namespace app\models;

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    require_once "../vendor/autoload.php";

    class ExportToPdf {

        public function export($product) {
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();

            $title = $product['product_title'];
            $description = $product['product_description'];
            $price = $product['product_price'];
            $category = $product['category_name'];
            $region = $product['region_name'];
            $user = $product['user_username'];

            $html = "<div style='width: 100%; background: #F2F2F2; padding: 30px; box-sizing: border-box;'> 
                        <table style='border: 1px solid #2F3948; border-collapse: collapse; width: 80%; margin: 20px auto; color:#2F3948'>
                            <thead>
                                <tr>
                                    <th scope='col' colspan='2' style='text-align: center;'>Product informations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product title</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$title</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product description</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$description</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product price</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$price</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product category</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$category</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Region</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$region</td>
                                </tr>
                                <tr>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>User</td>
                                    <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$user</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>";
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();
        }
    }

