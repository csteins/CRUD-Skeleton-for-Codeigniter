<?
/*
 * Provides the quick generation of testdata
 */
/**
 * Generates test data from dictionaries
 *
 * @param string $type Type of the test data to generate
 * @param int $length Length of the test data
 * @param int $min Min value of the test data
 * @param int $may Max value of the test data

 * @return string Returns test data.
 */
function generate_testdata($type="",$length=0,$min=0,$max=9999) {
	switch ($type)
	{
		//Generic test data types
		case "number":
			$data = mt_rand($min,$max);
			break;
		case "character":
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
			$code = "";
			$clen = strlen($chars) - 1;  //a variable with the fixed length of chars correct for the fence post issue
			while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0,$clen)];  //mt_rand's range is inclusive - this is why we need 0 to n-1
			}
			$data = $code;
			break;
		case "text":
			$array = array("Lorem","ipsum","dolor","sit","amet","consectetuer","adipiscing","elit","Etiam","accumsan","neque","nec","purus","Sed","tellus","Nulla","sit","amet","velit","Etiam","in","elit","quis","nisi","pulvinar","elementum","Nunc","egestas","auctor","odio","Aenean","sed","neque","eget","orci","nonummy","congue","Sed","interdum","quam","quis","ante","Morbi","condimentum","In","suscipit","Mauris","porta","aliquam","ipsum","Ut","auctor","Quisque","pellentesque","tempor","tortor","Proin","fermentum","tincidunt","diam","Aenean","tristique","dolor","nec","mi","Vivamus","libero","Vestibulum","ac","pede","Etiam","nec","arcu","eget","ligula","laoreet","viverra","Quisque","fringilla","Integer","mollis","lacus","vel","sodales","dapibus","neque","neque","ultricies","lacus","quis","tristique","urna","nisi","et","urna","Fusce","ligula","quam","iaculis","rutrum","sagittis","auctor","pellentesque","vitae","est","Sed","in","est","Aliquam","pulvinar","dictum","enim","Proin","nulla","Proin","eu","nisl","Praesent","urna","quam","porta","non","vulputate","congue","egestas","lacinia","lorem","Cras","sit","amet","dolor","ac","sapien","fringilla","fringilla","Proin","a","felis","sed","tortor","tempor","fringilla","Duis","fermentum","ante","ut","tellus","Sed","neque","nisl","aliquam","nec","vehicula","ut","varius","vitae","erat","Etiam","a","ipsum","Nullam","vel","neque","Curabitur","vestibulum","placerat","neque","Duis","dictum","diam","a","pellentesque","egestas","sem","tellus","ornare","risus","a","ultrices","turpis","odio","eget","diam","Vestibulum","lobortis","hendrerit","nisl","Nulla","consectetuer","mi","id","dui","Nulla","facilisi","Vestibulum","dignissim","laoreet","nulla","Aliquam","ultricies","mi","ac","scelerisque","elementum","mauris","diam","bibendum","sapien","a","rhoncus","justo","sapien","vitae","sapien","Mauris","arcu","Donec","condimentum","magna","id","nulla","consectetuer","blandit","In","at","nisi","Fusce","adipiscing","eros","non","sapien","Aenean","euismod","mi","id","malesuada","dictum","erat","urna","viverra","sem");
			$start = mt_rand(0,count($array) - $length);
			$data ="";
			for($i=$start;$i<$start+$length;$i++) {
				$data .= $array[$i] . " ";
			}
			break;
		//Specialized test data types
		case "title":
			$array = array('Prof.','Dr.','MdL','','','','','','','');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
		case "surname":
			$array = array('Esther', 'Anna', 'Marek', 'Marcus', 'Peter',
			  'Bastian','Pekka', 'Michael','Stefan','Horst',
			 'Helmut','Gerhard','Manfred','Josef','Ines',
			 'Julia','Oliver','Jeanette','Katharina','Hans','Hanna','Hannah','Leonie','Lena',
			 'Anna','Lea','Lara','Mia','Laura','Lilly','Emily','Sara','Sarah','Emma','Nele',
			 'Neele','Marie','Sophie','Sofie','Johanna','Julia','Maja','Maya','Lisa','Lina',
			 'Amelie','Amely','Alina','Leni','Sofia','Sophia','Louisa','Luisa','Paula','Clara',
			 'Klara','Angelina','Josefine','Josephine','Charlotte','Jana','Chiara','Kiara','Annika',
			 'Lukas','Lucas','Luca','Luka','Finn','Fynn','Tim','Timm','Felix','Jonas','Luis','Louis',
			 'Maximilian','Julian','Max','Paul','Niclas','Niklas','Jan','Ben','Elias','Jannick','Jannik',
			 'Yannic','Yannick','Yannik','Philipp','Philip','Phillip','Noah','Tom','Moritz','Nico','Niko',
			 'David','Nils','Niels','Simon','Fabian','Erik','Eric','Justin','Alexander','Jakob','Jacob','Florian',
			 'Nick','Linus','Mika','Jason','Daniel','Lennard','Lennart','Marvin','Marwin','Jannis','Yannis');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
				
		case "familyname":
			$array = array('Schmidt', 'Haiduk', 'Weber', 'Wagner', 'Müller',
			  'Mayer','Öner', 'Hegemann', 'Pellmann','Hug',
			  'Klose','Kohl','Merkel','Steinmann','Schröder',
			  'Röttger','Kranner','Metzger','Ehl','Steins','Müller',
			  'Schmidt','Schneider','Fischer','Weber','Meyer','Wagner',
			  'Becker','Schulz','Hoffmann','Schäfer','Koch','Bauer','Richter',
			  'Klein','Wolf','Schröder','Neumann','Schwarz','Zimmermann','Braun',
			  'Krüger','Hofmann','Lange','Schmitt','Schmitz','Krause','Meier',
			  'Lehmann','Schmid','Schulze','Maier','Köhler','König','Mayer','Huber');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
		case "company":
			$array = array('BMW', 'Deutsche Bank', 'Bayer', 'RAG',
			  'E.on','adidas', 'Siemens', 'Deutsche Telekom','eBay',
			  'Google','Daimler','Merck','Deutsche Lufthansa','Deutsche Post',
			  'Continental','BASF','Fresenius','Henkel','Infineon','Hypo','Linde'
			  ,'MAN','METRO','RWE','SAP','ThyssenKrupp','Volkswagen');
			  $data = $array[mt_rand(0,count($array) - 1)];
			  break;
		case "division":
			$array = array('', '', '', '', '', '', 'Finanzabteilung', 'Controlling',
			  'Human Resources','Marketing');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
		case "type_of_business_entity":
			$array = array('GbR', 'GmbH', 'Ltd.', 'AG', 'Co. KG',
			  'e.V.','gGmbH', '');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
				
		case "street":
			$array = array('Gustav-Schwab-Straße', 'Hauptstr.', 'Karlsstraße', 'Kantstr.', 'Lichtensteinstraße',
			  'Reutlinger Straße','Raichbergstr.', 'Geflügelgasse', 'Berliner Platz','Ringstraße',
			  'Königstr.','Hansstr.','Alteburg-Straße','Waldstraße','Unter den Linden',
			  'Auf der Kumpe','Hanfweg','Emmastraat','Bei den Lindenwiesen','Ernst-Flöder-Weg');
			$data = $array[mt_rand(0,count($array) - 1)] . " " . mt_rand(0,240);
			break;
			$data = mt_rand(10000,99999);
			break;
		case "city":
			$array = array('Rostock','Sundern','Stuttgart','Karlsruhe','Mannheim',
			  'Hamburg','Köln','Berlin','Hannover','Bremen',
			  'Aachen','Essen','Duisburg','Wuppertal','Dresden',
			  'Nürnberg','München','Passau','Freiburg','Leipzig');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;

		case "country":
			$array = array('Deutschland','Frankreich','England','Schweiz','Österreich','Italien','Bulgarien','Südafrika','Spanien');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
		case "position":
			$array = array('Geschäftsführer','Gesellschafter','Eigentümer','Leiter IT','Leiter Technik','Leiter Marekting','Assistenz Einkauf','Assistenz Technik','Assistenz Geschäftsleitung','Assistenz IT','Auszubildner');
			$data = $array[mt_rand(0,count($array) - 1)];
			break;
		case "telephone":
			$data = "0" . mt_rand(1000,9000) . "-" . mt_rand(100000,90000000);
			break;
		case "fax":
			$data = "0" . mt_rand(1000,9000) . "-" . mt_rand(100000,90000000);
			break;
		case "mobil":
			$array = array('0155','0160','0171','0172','0165','0152');
			$data =  $array[mt_rand(0,count($array) - 1)] . "-" . mt_rand(100000,90000000);
			break;
		case "email":
			$array = array('Peter.Wagner','Karl.Meiter','Juergen.Schmidt','Anna.Groegner','Alfons.Hegemann','Horst.Schmidt','Marie.Kajewski','fw.mayer','hans.feldmann', 'gerhard.heymer','info','webmaster','mail','welcome');
			$array2 = array('google','gmx','wagnerwagner','msn','spiegel','heise','web','epost','freenet','alice','t-online','arcor','hansanet','1und1','puretec','domainfactory');
			$array3 = array('.net','.de','.org','.com','.co.za','.br','.us','.co.uk');
			$data = $array[mt_rand(0,count($array) - 1)] . "@" . $array2[mt_rand(0,count($array2) - 1)] . $array3[mt_rand(0,count($array3) - 1)];
			break;
		case "website":
			$array2 = array('google','gmx','wikipedia','msn','spiegel','heise','web','epost','ebay','netzzeitung','n24');
			$array3 = array('.net','.de','.org','.com','.co.za','.br','.us','.co.uk');
			$data = "http://www." . $array2[mt_rand(0,count($array2) - 1)] . $array3[mt_rand(0,count($array3) - 1)];
			break;
		case "birthday":
			$data = mt_rand(0,29) . "." . mt_rand(0,12) . "." . mt_rand(1940,1990);
			break;
		default:
			$data = "";
			break;
	}
	return $data;
}


/**
 * Generates test data by randomly pick a value of a specificed database table attribute
 *
 * @param string $table Name of the database table 
 * @param string $attribute Name of the database table attribute to select 
 * @param mixed[] $where Where clause to limit the selections space

 * @return string Returns a randomly picked value of the database table attribute.
 */
function generate_testdata_from_sql($table,$attribute,$where="") {
	// Load the database library
    $ci=& get_instance();
    $ci->load->database(); 
	$sql = 'SELECT ' .  $attribute . ' FROM '  . $table . $where;
	$query = $ci->db->query($sql);
	$data = "";
	if ($query->num_rows() > 0) {
		foreach ($query->result_array() as $row)  {    // Go through the result set
			$array[] = $row["$attribute"];
		}
		$data  = $array[mt_rand(0,count($array) - 1)];
	}
	return $data;
}
?>
