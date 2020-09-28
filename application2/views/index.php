<?php
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
$data['user'] = $this->session->userdata('user');
$this->load->view($head,$data);
echo "<body>";
$this->load->view($header,$data);
echo "<div class='page-content'>";
$this->load->view($menu,$data);
echo "<div class='content-wrapper'>";
$this->load->view($content,$data);
$this->load->view($footer);

echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";
