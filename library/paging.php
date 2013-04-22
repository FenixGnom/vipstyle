<?php

	class Paging
	{

		static function MakePaging($all_count,$count_per_page,$act_page,$link)
		{
			//$all_count Всего страниц,
			//$count_per_page 
			//$act_page Активная страница
			//$link	-ссылка
			$returnLink= array();
			$settings = Registry::getParam('user_settings');
			//$nums = $count_per_page;

			
			$page = $act_page;
			
			$elements = $all_count;
			
			

			$pages = ceil($elements/$count_per_page);

			if ($pages <= 1) {
				return $returnLink;
				
			}
			if ($page < 1) {
				return $returnLink;
				
			}
			elseif ($page > $pages) {
				$page = $pages;
			}		

			$neighbours = $settings['prodpageslade'];
			
			$left_neighbour = $page - $neighbours;
			if ($left_neighbour < 1) $left_neighbour = 1;

			$right_neighbour = $page + $neighbours;
			if ($right_neighbour > $pages) $right_neighbour = $pages;

			
			$iterator=0;
			for ($i=$left_neighbour; $i<=$right_neighbour; $i++) {
				if ($i != $page) {
					$act=false;		
				}
				else {
					// выбранная страница
					$act=true;
				}
				$returnLink[$iterator]=new MenuLinkStorage($i, $link.'/page/' . $i, $act);
				$iterator++;
				
				
			}

			
			
			return $returnLink;
        }



            static function AjaxPaging($all_count,$count_per_page,$act_page,$link)
		{

                        $link = $link;

                        $settings = Registry::getParam('user_settings');

			$left = '&#8592;';
			$right = '&#8594;';
                        $kols=$settings['prodpageslade'];
                        $array_pages=array();
			$start = ($act_page-1)*$count_per_page;
			$end = $count_per_page+$start;
			$pages_count = $all_count / $count_per_page;

                        for($j=0;$j<$pages_count;$j++)
                        {
                            $array_pages[$j]=$j+1;
                        }

                        $new_ar=array_chunk($array_pages,$kols);

                         if ($all_count>$settings['prodperpage'])
                         {



                                         if($act_page <= $kols)
                                         {
                                            $id=0;

                                         }
                                         else
                                         {
                                           if($act_page%$kols==0)
                                              $id=($act_page/$kols)-1;
                                           else
                                              $id=(int)($act_page/$kols);
                                         }



                                                    for ($i=0;$i<$kols;$i++) {
                                                              if(isset($new_ar[$id][$i]))
                                                              {
                                                                     if ($act_page == $new_ar[$id][$i])
                                                                {
                                                                       $p = $new_ar[$id][$i];
                                                                       $linkTo = '<font class="link_paging_nav">' . $p . '</font>';
                                                                    }
                                                                    else
                                                                    $linkTo = '<a class="link_paging" href="javascript:pagings(' . $link . '/page/' . $new_ar[$id][$i] . ');">' . $new_ar[$id][$i] . '</a>';


                                                               $pages[] = $linkTo;

                                                              }
                                                             }
                                                    if (count($pages)<2) {return '';}
                                                    if ($act_page > 1) {
                                                            $buttons_prev = ' <a class="link_paging" href="javascript:pagings(' . $link . '/page/' . ($act_page-1) . ');">' . $left . '</a> '; }
                                                    if ($pages_count>$act_page) {
                                                            $buttons_next = ' <a class="link_paging" href="javascript:pagings(' . $link . '/page/' . ($act_page+1) . ');">' . $right . '</a> '; }

                                                    $html = '<table border="0" ><tr><td style="padding:5px;color:#000000">' . @$buttons_prev . '</td>';
                                                    for ($i=0;$i<count($pages); $i++) {
                                                            $html = $html . '<td style="padding:5px;">' . $pages[$i] . '</td>';
                                                    }

                                                    $html = $html . '<td style="padding:5px;color:#000000">' . @$buttons_next . '</td></tr></table>';
                                                    return $html;
                             }
                             else
                             {
                                    return '';
                             }
            }
	}

?>