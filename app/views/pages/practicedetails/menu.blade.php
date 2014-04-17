
	<nav id="app-nav" class="navbar navbar-default" role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
			<?php 
				$completed_tabs = array();
				$completed_tab_index = null;
				$current_tab_index = null;
				
				if ($user->accountant && $user->accountant->last_tab) {
					foreach (array_keys($practice_detail_tabs) as $index => $key) 
					{
						$completed_tabs[] = $key;
						
						if ($key == $user->accountant->last_tab) {
							$completed_tab_index = $index;
							break;
						}
					}
				}
				/*echo "<pre>";
				var_dump($user->accountant->last_tab);
				echo "<br/>";
				var_dump($completed_tabs);
				echo "</pre>";
				die;*/
				
				$i = 0;
			?>
			
			@foreach ($practice_detail_tabs as $key => $display)
				<?php $class = $practice_detail_current_tab == $key ? 'class="active"' : ""; ?>
				
				<?php
					if ($key == $practice_detail_current_tab) {
						$current_tab_index = $i;
					}
				?>
				
				@if ((in_array($key, $completed_tabs) && $i !== $current_tab_index) || ($completed_tab_index !== null && $i == $completed_tab_index + 1 && $current_tab_index !== $completed_tab_index + 1)) 
					<li {{ $class }}><a href="{{ url("practicedetails/" . $key) }}">{{ $display }}</a></li>
				@else
					<?php $color = ($i == $current_tab_index ? '' : "color: #000000; "); ?>
					<li {{ $class }}><a href="#" style="{{ $color }}cursor: default;">{{ $display }}</a></li>
				@endif
				
				<?php $i++; ?>
			@endforeach
	    </ul>
	  </div><!-- /.navbar-collapse -->
	</nav>
