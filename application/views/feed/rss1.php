<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">	
       <channel>
    
    <title><?php echo $feed_name; ?></title>	
    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>   
	<atom:link href="<?php echo base_url()?>feed/petitii_recente" rel="self" type="application/rss+xml" />
	<?php foreach($last_petitions as $post): ?>    
    <item>
        <title>
			<?php echo xml_convert($post['titlu']); ?>
		</title>
        <link>
			<?php echo base_url().'search/view_petitie/'.$post['id']?>
		</link>
        <guid>
			<?php echo base_url().'search/view_petitie/'.$post['id']?>
		</guid>
		<pubDate><?php echo date("D, d M Y H:i:s O", strtotime($post['data']))?></pubDate>
        <description>
			<?php echo $post['descriere'] ?>
		</description>		  		  
    </item>       
    <?php endforeach; ?>	    		
    </channel>
</rss> 
