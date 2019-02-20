<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <?php
            foreach ($this->uri->segments as $segment) {
              $url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)). $segment;
              $is_active = $url == $this->uri->uri_string;
          ?>
              <li class="breadcrumb-item <?php echo $is_active ? 'active' : '' ?>"></li>
              <?php 
                if ($is_active) {
                  echo "&nbsp;".ucfirst($segment);
                }
                else {
              ?>
                  <a href="<?php echo site_url($url) ?>"><?php echo ucfirst($segment)." / "?></a>
              <?php
                }    
              ?>
          <?php
            }
          ?>
        </ol>