<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.8.20080808
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
# 
# 
#  Copyright © 2007-2008 Vincent Hor 
############################################################################

/***********************************/
/* Class for Cal namespace objects */
/***********************************/

class CalObject
{
	var $ev_title = "";
	var $day = "";
	var $month = "";
	var $year = "";
	var $wkday = "";
	var $start = "";
	var $end = "";
	var $ev_email = "";
	var $ev_url = "";
	var $ev_cat = "";
	var $ev_location = "";
	var $ev_description = "";
	var $ev_link = "";
	var $objCount = 0;
}

/***********************************/
/* Class for standard RSS elements */
/***********************************/
class RSS_1_0_Parser
{
    var $insidechannel = false;
    var $channeltitle = "";
    var $insideimage = false;
    var $imagetitle = "";
    var $imagesrc = "";
    var $imagelink = "";	
    var $insideitem = false;
    var $insidecal = false;
    var $calobj ;
    var $tag = "";
    var $title = "";
    var $description = "";
    var $category = "";
    var $pubdate = "";
    var $link = "";
	var $currentdate = "";
	var $Month = array("Jan"=>1,"Feb"=>2,"Mar"=>3,"Apr"=>4,"May"=>5,"Jun"=>6,"Jul"=>7,"Aug"=>8,"Sep"=>9,"Oct"=>10,"Nov"=>11,"Dec"=>12);

	var $itemArr = array();
	var $itemCount = 0;
	
	function setDate($thedate)
	{
		$this->currentdate = $thedate;		
	}
	function startElement($parser, $tagName, $attrs)
    {
		$this->tag = $tagName;

        if ($tagName == "CHANNEL")
        {
			$this->insidechannel = true;
	  	}
        elseif ($tagName == "IMAGE")
        {
			$this->insideimage = true;
	  	}
        elseif ($tagName == "ITEM")
        {
            $this->insideitem = true;
        }
        elseif ($tagName == "CAL:CALENDARIX")
        {
			$this->insidecal = true;
			$this->calobj = new CalObject();
	  	}
   	}

	function endElement($parser, $tagName)
	{
		global $mth;
		if ($tagName == "IMAGE")
        	{
			$this->insideimage = false;
	      	//echo "<div class=headerfont>".$this->channeltitle."</div>\n";
	  	}
        else if ($tagName == "ITEM")
        {
       	  //echo "<h3>PUBDATE: ".$this->pubdate."</h3>";        	
		  if (!$this->calobj)        	
		  {
        	if (trim($this->pubdate)!="")
        	{
        		$rfc2822 = split(" ",$this->pubdate); 
        		if (strpos($rfc2822[0],",")>0) array_shift($rfc2822);	// remove day-of-week if present
        		$rssd = ltrim(trim($rfc2822[0]),"0");        		
	        	$rssm = $this->Month[trim($rfc2822[1])];
				$rssy = trim($rfc2822[2]);   
				if (!isset($this->itemArr[$rssd][$rssm][$rssy]['count'])) 
						$this->itemArr[$rssd][$rssm][$rssy]['count'] = 0;
				else $this->itemArr[$rssd][$rssm][$rssy]['count']++;
				$this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['title'] = trim(str_replace('&#39;','&#146;',strip_tags($this->title)));
				$this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['link'] = trim($this->link);
	            $this->itemCount++;
			}
			$this->title = "";
			$this->description = "";
			$this->category = "";
			$this->link = "";
			$this->pubdate = "";
			$this->insideitem = false;
		  }
        }               
        elseif ($tagName == "CAL:CALENDARIX")
        {
		  //$this->insidecal = false;			
		  $rssd = trim($this->calobj->day);
		  $rssm = trim($this->calobj->month);
		  $rssy = trim($this->calobj->year); 	
		  if ($this->calobj)
		  {		  	
			if (!isset($this->itemArr[$rssd][$rssm][$rssy]['count'])) 
				$this->itemArr[$rssd][$rssm][$rssy]['count'] = 0;
			else $this->itemArr[$rssd][$rssm][$rssy]['count']++;		  		
	  		$this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['title'] = trim($this->calobj->ev_title);
			$this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['link'] = trim($this->calobj->ev_link);
			
			  $this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['starttime'] = trim($this->calobj->start) ;
			  $this->itemArr[$rssd][$rssm][$rssy][$this->itemArr[$rssd][$rssm][$rssy]['count']]['endtime'] = trim($this->calobj->end);
			$this->calobj->objCount++;	    	
		  }
		}
		
		elseif ($tagName == "CHANNEL")
		{
/*			
	      	echo "<br><div align=center><a href=".$this->imagelink." target=_BLANK><img src=".$this->imagesrc." border=0 align=center alt='".$this->imagetitle."'></a></div>\n";
*/	      	
		}
    }
    function characterData($parser, $data)
    {
	  if ($this->insideitem)
      {
      	switch ($this->tag)
        {
           	case "TITLE":
               	$this->title .= str_replace("\n","",$data);  // remove new lines
               	break;
            case "DESCRIPTION":
                $this->description .= $data;
               	break;
            case "LINK":
                $this->link .= $data;
           		break;
           	case "CATEGORY":
           		$this->category .= $data;
           		break;
           	case "PUBDATE":
           		$this->pubdate .= $data;
           		break;
		}
	  }
	  elseif ($this->insidecal)
	  {
      	switch ($this->tag)
        {
        	case "CAL:WKDAY":
              	$this->calobj->wkday .= $data;
              	break;
        	case "CAL:DAY":
              	$this->calobj->day .= $data;
              	break;
            case "CAL:MONTH":
                    $this->calobj->month .= $data;
              	break;
            case "CAL:YEAR":
                    $this->calobj->year .= $data;
              	break;
            case "CAL:EV_START":
                    $this->calobj->start .= $data;
              	break;
            case "CAL:EV_END":
                    $this->calobj->end .= $data;
              	break;
            case "CAL:EV_TITLE":
                    $this->calobj->ev_title .= $data;
              	break;
            case "CAL:EV_CAT":
                    $this->calobj->ev_cat .= $data;
              	break;
            case "CAL:EV_LOCATION":
                    $this->calobj->ev_location .= $data;
              	break;
            case "CAL:EV_DESCRIPTION":
                    $this->calobj->ev_description .= $data;
              	break;
            case "CAL:EV_LINK":
                    $this->calobj->ev_link .= $data;
              	break;
			}
	  	}
	  	elseif ($this->insideimage)
	  	{
		  switch ($this->tag)
		  {
			case "TITLE":
				$this->imagetitle .=$data;
				break;
			case "URL":
				$this->imagesrc .=$data;
				break;
			case "LINK":
				$this->imagelink .=$data;
				break;
		  }
	    }
	    elseif ($this->insidechannel)
	    {
		  switch ($this->tag)
		  {
			case "TITLE":
			{
				if (!$this->insideimage)
					$this->channeltitle .= $data;
				break;
			}
	  	  }
	    }
	}
	
	function GetItems()
	{
		//echo "<h1>".count($this->itemArr)."</h1>";
		return $this->itemArr;
	}
}

/*******************************/
/* Class for Getting RSS Feed  */
/*******************************/
class GetWebObject
{
	var $host = "";
	var $port = "";
	var $path = "";
	var $header = array();
	var $content = "";
	var $FETCH_TIMEOUT = 10;	// seconds timeout in connection	
	
	function GetWebObject($host, $port, $path)
	{
		$this->host = $host;
		$this->port = $port;
		$this->path = $path;
		$this->fetch();
	}

	function fetch()
	{
		$fp = fsockopen ($this->host, $this->port, $errno, $errstr, $this->FETCH_TIMEOUT);
	
		if(!$fp) { return; /*("RSS could not connect to host."); */}
	
		$header_done=false;
	
		$request = "GET ".$this->path." HTTP/1.0\r\n";
		$request .= "User-Agent: Mozilla/4.0 (compatible; MSIE 5.5; Windows 98)\r\n";
		$request .= "Host: ".$this->host."\r\n";
		$request .= "Connection: Close\r\n\r\n";
		$return = '';
		
		fputs ($fp, $request);

		stream_set_timeout($fp, $this->FETCH_TIMEOUT);	
		$line = fgets ($fp, 128);
		$info = stream_get_meta_data($fp);
		if ($info['timed_out']) return;
		
		$this->header["status"] = $line;
		$stats = split(" ",$this->header["status"]);
		//	Handle redirection
		if (($stats[1]=="301")||($stats[1]=="302"))
		{
			while (!feof($fp))
			{					
				stream_set_timeout($fp, $this->FETCH_TIMEOUT);
				$line = fgets ( $fp, 128 );
				$info = stream_get_meta_data($fp);
				if ($info['timed_out']) break;
				if (strpos($line,"Location")===FALSE) continue ;
				else 
				{
					$loc = split(" ",$line);
					$this->path = trim($loc[1]);
					$this->header["path"] = $this->path;
					$urlparts = split("/",$loc[1]);
					$this->host = trim($urlparts[2]);
					$this->header["host"] = $this->host;
				}
			}								
		}
		else
		{		
			while (!feof($fp))
			{		
				stream_set_timeout($fp, $this->FETCH_TIMEOUT);
				$line = fgets ( $fp, 128 );
				$info = stream_get_meta_data($fp);
				if ($info['timed_out']) break;				
				if($header_done) { $this->content .= $line;}
				else
				{
					if($line == "\r\n")
						{ $header_done=true;}
					else
					{
						$data = explode(": ",$line);
						if (count($data)>1)
						  $this->header[$data[0]] = $data[1];
					}
				}
			}
		}	
		fclose ($fp);
	}
	
	function get_header() { return($this->header);}
	
	function get_content() { return($this->content);}
}


/******************/
/* Get RSS events */
/******************/

function RSS($rssd,$rssm,$rssy){
global $rssfeeds, $rssurl, $rssview;
	if (isset($rssview)) $rssindex = $rssview;
	else $rssindex = 0;
	$rssdate = date("j/n/Y",mktime(0,0,0,$rssm,$rssd,$rssy));
	
	$xml_parser = xml_parser_create();

	$rss_parser = new RSS_1_0_Parser();
//	$rss_parser->setDate($rssdate);

	xml_set_object($xml_parser,$rss_parser);
	xml_set_element_handler($xml_parser, "startElement", "endElement");
	xml_set_character_data_handler($xml_parser, "characterData");

	$file = new GetWebObject($rssfeeds[$rssindex][1], 80, $rssfeeds[$rssindex][2]);
	$datas = $file->get_header();

	//echo $datas["status"];
	//echo $datas["Content-Type"];	
	if (isset($datas["path"])) // handles redirection (301/302)
	{
		//echo "<h3>".$datas["path"]."</h3>";			
		//if (isset($datas["host"])) echo "<h3>".$datas["host"]."</h3>";		
		$fileloc = new GetWebObject($datas["host"], 80, $datas["path"]);
		$fp = $fileloc->get_content();
	}
	else
	{
		$fp = $file->get_content();
	}
	$xml_declaration = "<?xml version=\"1.0\" ?>";	
	$new_contents="";
	$xml_declaration_count = substr_count(Substr($fp,0,10),"<?xml");
	if($xml_declaration_count == "0")
	{
		$new_contents = $xml_declaration . $fp ;
	}
	else
	{
		$new_contents = $fp;
	}
	if (!xml_parse($xml_parser, $new_contents ) )
    {
	    //echo($fp);
	    // ignore xml parse error to proceed calendar display
	    /*
	    die(sprintf("Unable to parse : XML error: %s at line %d",xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)));
	    */
    }
		
	xml_parser_free($xml_parser);

	return $rss_parser->GetItems();
}


?>