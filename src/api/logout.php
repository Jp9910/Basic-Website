<?php

namespace Jp\SindicatoTrainees\api;

session_destroy();
session_start();

header('Location: /login');