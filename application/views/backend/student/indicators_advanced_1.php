<div class="row">
            
            <div class="col-md-12">
            
                <?php
                $data['Average_number_of_sick_cats_reported_in_reports_from_villages_up_to_two_decimal_points'] = $Average_number_cats_reported_villages->Average_numbe_cats_reported_villages;
               
                foreach($deaths_disease as $key=>$deaths){ //echo '<pre>';print_r($deaths);
                    $newdata["total_number_of_deaths_from_each_disease"][$deaths['name']] = $deaths['SUM(ad.number_mortality)'];
                }

                $response = array_merge($data, $newdata);

                echo '<pre>';
                    echo json_encode($response, JSON_PRETTY_PRINT);
                echo '</pre>';
                
                $json = json_encode($response, JSON_PRETTY_PRINT);
                file_put_contents('indicators_advanced_1.json', $json);

                 if ( ! write_file('indicators_advanced_1.json', $response))
                 {
                     echo 'Unable to write the file';
                 }
                 else
                 {
                     echo 'file written';
                 }
                ?>
                
            </div>
           
</div>
