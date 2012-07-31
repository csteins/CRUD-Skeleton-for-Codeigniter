<?
/*
 * Generates the controller and views based on the model
 */

/**
 * Generates a controller from a model
 *
 * @param string $name Name of the model
 * @param bool $write Write to file or not
 */
function generate_controller($name="",$write = false) {
	$model = $name . "model";
	// Load the database library
    $ci=& get_instance();
    $ci->load->model($model);
	
    $empty_array = array();
    $post_fields = array(); 
    $columns = $ci->$model->getColumns();
    foreach ($columns as $value) {
		$empty_array[] = '$data[\'' . $name . '\'][\'' . $value .'\'] = \'\';';     	
		$post_fields[] = '$_POST[\'' . $name . '\'][\'' . $value . '\'] = generate_testdata();';     	
    }
    
    $controller = file('application/code_generation_templates/controller.src');
    $search = array('[[name]]','[[primary_key]]','[[emptyarray]]','[[post_fields]]');
    $replace = array($name,$ci->$model->getPrimaryKey(),implode("\n      ",$empty_array),implode("\n     	",$post_fields));
    if ($write) {
    	$handle = fopen('application/controllers/' . $name . '.php' , 'w+');
    }
    foreach ($controller as $value) {
        $value= str_replace($search,$replace,$value);
        if ($write) {
        	fwrite($handle, $value);
        } else {
			echo $value;
        }
    }
    if ($write) {
    	fclose($handle);
    	chmod('application/controllers/' . $name . '.php', 0777);
    }
}

/**
 * Generates a detail view from a model
 *
 * @param string $name Name of the model
 * @param bool $write Write to file or not
 */
function generate_detailview($name="",$write = false) {
	$model = $name . "model";
	// Load the database library
    $ci=& get_instance();
    $ci->load->model($model);
	
    $fields = array(); 
    $columns = $ci->$model->getColumns();
    unset($columns[array_search($ci->$model->getPrimaryKey(), $columns)]);
    foreach ($columns as $value) {
		$fields[] = '    <tr valign=\'top\'>
            <td align=\'left\'><b>'.  $value . ':</b></td>
            <td>
               <input type=\'text\' name=\''.  $name . '['.  $value . ']\' value=\'<?= $'.  $name . '[\''.  $value . '\']; ?>\'/>
            </td>
    </tr>';     	
    }
    
    $controller = file('application/code_generation_templates/details_view.src');
    $search = array('[[name]]','[[primary_key]]','[[fields]]');
    $replace = array($name,$ci->$model->getPrimaryKey(),implode("\n",$fields));
    if ($write) {
    	mkdir('application/views/' . $name . '/');
    	$handle = fopen('application/views/' . $name . '/' . $name . 'details.php' , 'w+');
    }
    foreach ($controller as $value) {
        $value= str_replace($search,$replace,$value);
        if ($write) {
        	fwrite($handle, $value);
        } else {
			echo $value;
        }
    }
    if ($write) {
    	fclose($handle);
    	chmod('application/views/' . $name . '/' . $name . 'details.php', 0777);
    }
    
}

/**
 * Generates a over view from a model
 *
 * @param string $name Name of the model
 * @param bool $write Write to file or not
 */
function generate_overview($name="",$write = false) {
	$model = $name . "model";
	// Load the database library
    $ci=& get_instance();
    $ci->load->model($model);
	
    $gridrow = array(); 
    $columns = $ci->$model->getColumns();
    unset($columns[array_search($ci->$model->getPrimaryKey(), $columns)]);
    //Create table header
    $gridheader  = "<tr><td><b>" . implode("</b></td><td><b>",$columns) . "</b></td><td></td><td></td></tr>";
    //Create grid
    foreach ($columns as $value) {
		$gridrow[] = '<td align="left"><?= $row[\'' . $value. '\']; ?></td>';     	
    }
    $gridrow[] = '<td align="left"><a href = "<?= $modify_url."/".$row["' . $ci->$model->getPrimaryKey() . '"]; ?>" >Edit</a></td>';
    $gridrow[] = '<td align="left"><a href = "<?= $delete_url."/".$row["' . $ci->$model->getPrimaryKey() . '"]; ?>" onClick="javascript:return confirm(\'Delete?\');">Delete</a></td>';
    	
    $controller = file('application/code_generation_templates/grid_view.src');
    $search = array('[[name]]','[[primary_key]]','[[gridrow]]','[[gridheader]]');
    $replace = array($name,$ci->$model->getPrimaryKey(),implode("\n",$gridrow),$gridheader);
    
    if ($write) {
    	mkdir('application/views/' . $name . '/');
    	$handle = fopen('application/views/' . $name . '/' . $name . 'grid.php' , 'w+');
    }
    foreach ($controller as $value) {
        $value= str_replace($search,$replace,$value);
        if ($write) {
        	fwrite($handle, $value);
        } else {
			echo $value;
        }
    }
    
    if ($write) {
    	fclose($handle);
    	chmod('application/views/' . $name . '/' . $name . 'grid.php', 0777);
    }
    
}
?>