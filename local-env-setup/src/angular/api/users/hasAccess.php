<?php
session_start();

echo json_encode(["has_access" => $_SESSION["id"]]);