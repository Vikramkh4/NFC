<?= $this->extend('admin/layout/base') ?>

<?= $this->section('content') ?>

<!-- Page content -->
<div class="row">
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="<?=$users?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
		
					<h3>Registered users</h3>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-green">
					<div class="icon"><i class="entypo-user"></i></div>
					<div class="num" data-start="0" data-end="<?=$primary?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
		
					<h3>Total Clients</h3>
				</div>
		
			</div>
			
			<div class="clear visible-xs"></div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="entypo-box"></i></div>
					<div class="num" data-start="0" data-end="<?=$brands?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
		
					<h3>Total Brands</h3>
				</div>
		
			</div>
		
			<div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-suitcase"></i></div>
					<div class="num" data-start="0" data-end="<?=$product?>" data-postfix="" data-duration="1500" data-delay="1800">0</div>
		
					<h3>Total Products</h3>
				</div>
		
			</div>
            <div class="col-sm-3 col-xs-6">
		
				<div class="tile-stats tile-black">
					<div class="icon"><i class="entypo-chart-bar"></i></div>
					<div class="num" data-start="0" data-end="<?=$service?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
		
					<h3>Total Services</h3>
				</div>
		
			</div>
		</div>
 
<?= $this->endSection() ?>