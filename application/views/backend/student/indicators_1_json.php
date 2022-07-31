<div class="row">
            
            <div class="col-md-12">
            
                <?php
                $data['total_number_of_reported_cases_is'] = $total_number_cases;
               
                foreach($deaths_reported as $key=>$deaths){
                    $newdata["total_number_of_deaths_reported_at_each_location"][$deaths['location']] = $deaths['total_mortality'];
                }

                $set = array_merge($data, $newdata);

                //header('Content-Type: application/json; charset=utf-8');
                
                //echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
                echo '<pre>';
                    echo json_encode($set, JSON_PRETTY_PRINT);
                echo '</pre>';
                
                ?>
                
            </div>
           
</div>
