<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">	
       <channel>
    
    <title><?php echo $feed_name; ?></title>	
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>   
	<atom:link href="<?php echo base_url()?>feed/top_petitii" rel="self" type="application/rss+xml" />		    
	<?php foreach($top_petitions as $post2): ?>
	<item>
        <title>
			<?php echo xml_convert($post2['titlu']); ?>
			<?php echo ' | ' ?>
			<?php echo $post2['voturi'].' semnaturi' ?>
		</title>		 
        <link>
			<?php echo base_url().'search/view_petitie/'.$post2['id']?>
		</link>
        <guid>
			<?php echo base_url().'search/view_petitie/'.$post2['id']?>
		</guid>		
        <description>			
			<?php echo $post2['descriere'] ?>
		</description>		  		  
    </item>
	<?php endforeach; ?>	
    </channel>
</rss> 
