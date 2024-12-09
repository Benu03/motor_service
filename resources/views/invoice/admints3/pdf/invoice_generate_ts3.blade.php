<!DOCTYPE html>
<html>
<head>
	<title>{{ $invoice->invoice_no }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		
		.p1 {
 		 font-family: Arial, Helvetica, sans-serif;
		  color:rgb(224, 25, 3);
		  font-size: 14pt;
		  line-height: 1.5em;
		},
		.p2 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 6pt;
		line-height: 1.5em;
		}
		.p0 {
 		 font-family: Arial, Helvetica, sans-serif;
		  line-height: 0.5em;
		
		},
		.p5 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 6pt;
		line-height: 1.5em;
		},
		.p6 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 6pt;
		line-height: 1em;
		},
		th {
			text-align: center;
			},
		center{
			line-height: 0.5em;
		},
		.borderexample {
		border-width:1px;
		border-style:solid;
		border-color:#878787;
		}	
		
	</style>

	<p class="p0">
		<img src="{{ $logo }}" style="width:80px;">  PT.TS3 INDONESIA<br />
		<center class="p1">
			<b><u>INVOICE</u></b>	
		</center>
	</p>	
	<center class="p2" >
		<b>No. <?php echo $invoice->invoice_no ?></b>	
	</center>

	<p class="p5">
		Kepada:<br />
		PT. MITRA BISNIS MADANI<br/>
		Menara PNM Lantai 12<br />
		Jalan Kuningan Mulia,Kuningan Center Lot.3<br />
		Karet Kuningan, Setiabudi, Jakarta Selatan 12940<br />
		Berikut ini kami sampaikan invoice Rekapitulasi Biaya yang harus dibayar PT. Mitra Bisnis Madani<br />
		Bengkel TS3 Indonesia - Regional <?php echo $invoice_detail[0]->regional ?> <br />
		Periode : <?php echo $period->tanggal_service_min ?> - <?php echo $period->tanggal_service_max ?><br />
	</p>


	<center >
		<p class="p5">
		Daftar Rekapitulasi Biaya yang harus Dibayar PT. Mitra Bisnis Madani<br />
		Bengkel TS3 Indonesia<br />
		Regional Regional <?php echo $invoice_detail[0]->regional ?><br />
		Periode : <?php echo $period->tanggal_service_min ?> - <?php echo $period->tanggal_service_max ?><br />
		</p>
	</center>
	<table class='table table-bordered table-sm' style="font-size: 5pt;">
		<thead>
			<tr class="bg-info">                                                      
		   
				<th  width="10%">NOPOL</th> 
				<th width="15%">CABANG</th> 
				<th width="10%">INVOICE</th>  
				<th width="10%">Tanggal Service</th> 
				<th width="7%">KM</th>   
				<th width="7%">Jasa</th>  
				<th width="7%">Barang</th>  
				<th width="7%">PPN</th> 
				<th width="7%">PPH 23</th>    
				<th width="10%">Total Sebelum PPH 23</th>    
				<th width="10%">Total Sesudah PPH 23</th>    
		   
		</tr>
		</thead>

		 <tbody>
			
			<?php $i=1; foreach($invoice_detail as $ind) { ?>
			<tr>
			<td><?php echo $ind->nopol ?></td>     
			<td><?php echo $ind->branch ?></td>  
			<td><?php echo $ind->invoice_no ?></td>  
			<td><?php echo $ind->tanggal_service ?></td>  
			<td><?php echo $ind->last_km ?></td>                                             
			<td><?php echo "Rp " . number_format($ind->jasa,0,',','.'); ?></td>
			<td><?php echo "Rp " . number_format($ind->part,0,',','.'); ?></td>
			<td><?php echo "Rp " . number_format($ind->ppn,0,',','.'); ?></td>
			<td><?php echo "Rp " . number_format($ind->pph23,0,',','.'); ?></td>
			<td><?php echo "Rp " . number_format(($ind->part+$ind->jasa+$ind->ppn),0,',','.'); ?></td>
			<td><?php echo "Rp " . number_format(($ind->part+$ind->jasa+$ind->ppn)-$ind->pph23,0,',','.'); ?></td>
	
			</td>
			 </tr>
			 <?php                          
			 $sumjasa[] =$ind->jasa;
			 $sumpart[] =$ind->part;
			 $sumppn[] =$ind->ppn;
			 $sumpph23[] =$ind->pph23;
			 $sumbeforepph23[] = $ind->part+$ind->jasa+$ind->ppn;
			 $sumafterpph23[] = ($ind->part+$ind->jasa+$ind->ppn)-$ind->pph23;
			 ?> 
			<?php $i++; } ?> 
			<tr>
				<td colspan="5" class="bg-light"></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumjasa),0,',','.'); ?></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumpart),0,',','.'); ?></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumppn),0,',','.'); ?></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumpph23),0,',','.'); ?></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumbeforepph23),0,',','.'); ?></td>  
				<td><?php echo "Rp " . number_format(array_sum($sumafterpph23),0,',','.'); ?></td>  
			</tr>
	</tbody>
		
	</table>
	<p class="p5">
		<b>Terbilang:<br />
			<?php echo $terbilang ?>
		</b>
	</p>
	
		<label class="p6">Harap di transfer via No.Rekening :</label>
		<table border="1" style="font-size: 6pt;">
			<tr>
				<td width="40%">
					BCA ( a/n . PT. TEES THREE INDONESIA)<br />
					009.317.1818<br />
					Cab. Pemuda Semarang
				</td>
			</tr>
		</table>
	
	


 
</body>
</html>