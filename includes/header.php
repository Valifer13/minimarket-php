<?php
$url = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/indomaret/assets/css/style.css">
</head>
<body>
    <nav class="fixed top-0 start-0 flex w-full gap-5 px-4 py-2 border-b border-b-zinc-300 bg-white items-center justify-between">
        <button class="md:hidden block *:transition-all *:duration-200" id="btn-sidebar">
            <div class="mb-1 w-5 h-0.5 bg-black"></div>
            <div class="mb-1 w-5 h-0.5 bg-black"></div>
            <div class="w-5 h-0.5 bg-black"></div>
        </button>
        <h1 class="text-2xl font-bold tracking-tighter">∀ POS</h1>
        <ul class="md:flex hidden gap-5 align-center text-zinc-400 **:hover:text-zinc-800 **:transition-all **:duration-200 **:text-md **:font-medium **:tracking-tight">
            <li><a href="/indomaret/" class="<?= $url == "/indomaret/" ? "text-zinc-800": "" ?>">Dashboard</a></li>
            <li><a href="/indomaret/pages/cashiers/" class="<?= preg_match("#^/indomaret/pages/cashiers/.*#", $url) ? "text-zinc-800": "" ?>">Cashiers</a></li>
            <li><a href="/indomaret/pages/products/" class="<?= preg_match("#^/indomaret/pages/products/.*#", $url) ? "text-zinc-800": "" ?>">Products</a></li>
            <li><a href="/indomaret/pages/sales/" class="<?= preg_match("#^/indomaret/pages/sales/.*#", $url) ? "text-zinc-800": "" ?>">Sales</a></li>
            <li><a href="/indomaret/pages/purchases/" class="<?= preg_match("#^/indomaret/pages/purchases/.*#", $url) ? "text-zinc-800": "" ?>">Purchases</a></li>
            <li><a href="/indomaret/pages/customers/" class="<?= preg_match("#^/indomaret/pages/customers/.*#", $url) ? "text-zinc-800": "" ?>">Customers</a></li>
            <li><a href="/indomaret/pages/suppliers/" class="<?= preg_match("#^/indomaret/pages/suppliers/.*#", $url) ? "text-zinc-800": "" ?>">Suppliers</a></li>
        </ul>
        <button class="flex flex-col gap-0.5 md:hidden block">
            <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
            <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
            <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
        </button>
    </nav>
    <div id="sidebar" class="md:hidden fixed w-40 top-12 start-0 h-screen bg-zinc-100 list-none border-e border-t border-zinc-300 p-2 flex flex-col gap-2 *:px-4 *:py-2 *:focus:bg-zinc-100 *:font-medium transition-all duration-200 -translate-x-full">
        <a href="/indomaret/">Dashboard</a>
        <a href="/indomaret/pages/cashiers/">Cashiers</a>
        <a href="/indomaret/pages/products/">Products</a>
        <a href="/indomaret/pages/sales/">Sales</a>
        <a href="/indomaret/pages/purchases/">Purchases</a>
        <a href="/indomaret/pages/customers/">Customers</a>
        <a href="/indomaret/pages/suppliers/">Suppliers</a>
    </div>
    <section class="md:px-10 px-4 mt-17">