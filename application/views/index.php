<?php
echo "<!DOCTYPE html>";
echo "<html lang='en'>";

$this->load->view($head);
echo "<body>";
$this->load->view($header);
echo "<div class='page-content'>";
$this->load->view($menu);
echo "<div class='content-wrapper'>";
$this->load->view($content);
$this->load->view($footer);

echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";
