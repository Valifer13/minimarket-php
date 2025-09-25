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
    <nav class="">
        <!-- Navbar for Web -->
        <div class="hidden fixed top-0 start-0 md:flex flex-col bg-white min-w-10 md:w-[250px] h-screen gap-5 p-4 border-e border-zinc-300 shadow-zinc-300 shadow-lg transition-all duration-300">
            <div class="flex justify-center md:justify-between gap-5">
                <button class="text-3xl font-bold tracking-tighter flex gap-2 hover:cursor-pointer" id="btn-expand-sidebar">∀ <span class="hidden md:block">POS</span></button>
                <button class="hover:cursor-pointer hidden md:block" id="btn-shrink-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </button>
            </div>

            <div class="w-full h-[1px] bg-zinc-200"></div>

            <div class="flex flex-col gap-2 text-zinc-400 **:hover:text-zinc-800 **:transition-all **:duration-200 **:text-md **:font-medium **:tracking-tight **:px-2 **:py-1 **:hover:bg-zinc-200 **:rounded-md *:flex *:items-center">
                <a class="<?= $url == "/indomaret/" ? "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="hidden md:block">
                        Dashboard
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/cashiers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/cashiers/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="hidden md:block">
                        Cashiers
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/products/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/products/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="hidden md:block">
                        Products
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/vouchers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/vouchers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm0-160q17 0 28.5-11.5T520-480q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480q0 17 11.5 28.5T480-440Zm0-160q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm320 440H160q-33 0-56.5-23.5T80-240v-160q33 0 56.5-23.5T160-480q0-33-23.5-56.5T80-560v-160q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v160q-33 0-56.5 23.5T800-480q0 33 23.5 56.5T880-400v160q0 33-23.5 56.5T800-160Zm0-80v-102q-37-22-58.5-58.5T720-480q0-43 21.5-79.5T800-618v-102H160v102q37 22 58.5 58.5T240-480q0 43-21.5 79.5T160-342v102h640ZM480-480Z" />
                    </svg>
                    <span class="hidden md:block">
                        Vouchers
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/sales/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/sales/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <path d="M240-80q-50 0-85-35t-35-85v-120h120v-560l60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-560H320v440h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h240v80H360Zm0 120v-80h240v80H360Zm320-120q-17 0-28.5-11.5T640-640q0-17 11.5-28.5T680-680q17 0 28.5 11.5T720-640q0 17-11.5 28.5T680-600Zm0 120q-17 0-28.5-11.5T640-520q0-17 11.5-28.5T680-560q17 0 28.5 11.5T720-520q0 17-11.5 28.5T680-480ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm-40 0v-80 80Z" />
                    </svg>
                    <span class="hidden md:block">
                        Sales
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/purchases/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/purchases">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <path d="M80-120v-720h400v160h400v560H80Zm80-80h240v-80H160v80Zm0-160h240v-80H160v80Zm0-160h240v-80H160v80Zm0-160h240v-80H160v80Zm320 480h320v-400H480v400Zm80-240v-80h160v80H560Zm0 160v-80h160v80H560Z" />
                    </svg>
                    <span class="hidden md:block">
                        Purchases
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/customers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/customers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="hidden md:block">
                        Customers
                    </span>
                </a>
                <a class="<?= preg_match("#^/indomaret/pages/suppliers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/suppliers">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                        <path d="M160-280v-480H80v-80h160v480h600v80H160Zm80 200q-33 0-56.5-23.5T160-160q0-33 23.5-56.5T240-240q33 0 56.5 23.5T320-160q0 33-23.5 56.5T240-80Zm40-320v-240h240v240H280Zm80-80h80v-80h-80v80Zm200 80v-240h240v240H560Zm80-80h80v-80h-80v80ZM760-80q-33 0-56.5-23.5T680-160q0-33 23.5-56.5T760-240q33 0 56.5 23.5T840-160q0 33-23.5 56.5T760-80ZM360-480h80-80Zm280 0h80-80Z" />
                    </svg>
                    <span class="hidden md:block">
                        Suppliers
                    </span>
                </a>
            </div>
        </div>

        <!-- Navbar for mobile -->
        <div class="flex md:hidden justify-between px-4 py-3 border-b border-zinc-200">
            <button class="md:hidden block *:transition-all *:duration-200 hover:cursor-pointer" id="btn-sidebar">
                <div class="mb-1 w-5 h-0.5 bg-black"></div>
                <div class="mb-1 w-5 h-0.5 bg-black"></div>
                <div class="w-5 h-0.5 bg-black"></div>
            </button>
            <div class="flex justify-center md:justify-between gap-5">
                <button class="text-3xl font-bold tracking-tighter flex gap-2 hover:cursor-pointer" id="btn-expand-sidebar">∀ <span class="block">POS</span></button>
            </div>
            <button class="md:hidden block">
                <div class="flex flex-col gap-0.5 ">
                    <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
                    <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
                    <div class="bg-zinc-500 w-[6px] h-[6px] rounded-full"></div>
                </div>
            </button>
        </div>
    </nav>
    <div class="flex md:hidden fixed flex-col gap-2 w-full h-screen p-2 bg-white text-zinc-400 **:hover:text-zinc-800 **:transition-all **:duration-200 **:text-md **:font-medium **:tracking-tight **:px-2 **:py-1 **:hover:bg-zinc-200 **:rounded-md *:flex *:items-center transition-transform duration-300 -translate-x-full">
        <a class="<?= $url == "/indomaret/" ? "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            <span>
                Dashboard
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/cashiers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/cashiers/">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>
                Cashiers
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/products/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/products/">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
            </svg>
            <span>
                Products
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/vouchers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/vouchers">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                <path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm0-160q17 0 28.5-11.5T520-480q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480q0 17 11.5 28.5T480-440Zm0-160q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm320 440H160q-33 0-56.5-23.5T80-240v-160q33 0 56.5-23.5T160-480q0-33-23.5-56.5T80-560v-160q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v160q-33 0-56.5 23.5T800-480q0 33 23.5 56.5T880-400v160q0 33-23.5 56.5T800-160Zm0-80v-102q-37-22-58.5-58.5T720-480q0-43 21.5-79.5T800-618v-102H160v102q37 22 58.5 58.5T240-480q0 43-21.5 79.5T160-342v102h640ZM480-480Z" />
            </svg>
            <span>
                Vouchers
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/sales/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/sales/">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                <path d="M240-80q-50 0-85-35t-35-85v-120h120v-560l60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-560H320v440h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h240v80H360Zm0 120v-80h240v80H360Zm320-120q-17 0-28.5-11.5T640-640q0-17 11.5-28.5T680-680q17 0 28.5 11.5T720-640q0 17-11.5 28.5T680-600Zm0 120q-17 0-28.5-11.5T640-520q0-17 11.5-28.5T680-560q17 0 28.5 11.5T720-520q0 17-11.5 28.5T680-480ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm-40 0v-80 80Z" />
            </svg>
            <span>
                Sales
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/purchases/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/purchases">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                <path d="M80-120v-720h400v160h400v560H80Zm80-80h240v-80H160v80Zm0-160h240v-80H160v80Zm0-160h240v-80H160v80Zm0-160h240v-80H160v80Zm320 480h320v-400H480v400Zm80-240v-80h160v80H560Zm0 160v-80h160v80H560Z" />
            </svg>
            <span>
                Purchases
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/customers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/customers">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>
                Customers
            </span>
        </a>
        <a class="<?= preg_match("#^/indomaret/pages/suppliers/.*#", $url) ?  "bg-zinc-200 text-zinc-800" : "" ?>" href="/indomaret/pages/suppliers">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 -960 960 960" width="24px" fill="currentColor" stroke="currentColor" stroke-width="2">
                <path d="M160-280v-480H80v-80h160v480h600v80H160Zm80 200q-33 0-56.5-23.5T160-160q0-33 23.5-56.5T240-240q33 0 56.5 23.5T320-160q0 33-23.5 56.5T240-80Zm40-320v-240h240v240H280Zm80-80h80v-80h-80v80Zm200 80v-240h240v240H560Zm80-80h80v-80h-80v80ZM760-80q-33 0-56.5-23.5T680-160q0-33 23.5-56.5T760-240q33 0 56.5 23.5T840-160q0 33-23.5 56.5T760-80ZM360-480h80-80Zm280 0h80-80Z" />
            </svg>
            <span>
                Suppliers
            </span>
        </a>
    </div>
    <!-- <div id="sidebar" class="md:hidden fixed w-40 top-12 start-0 h-screen bg-zinc-100 list-none border-e border-t border-zinc-300 p-2 flex flex-col gap-2 *:px-4 *:py-2 *:focus:bg-zinc-100 *:font-medium transition-all duration-200 -translate-x-full">
        <a href="/indomaret/">Dashboard</a>
        <a href="/indomaret/pages/cashiers/">Cashiers</a>
        <a href="/indomaret/pages/products/">Products</a>
        <a href="/indomaret/pages/sales/">Sales</a>
        <a href="/indomaret/pages/purchases/">Purchases</a>
        <a href="/indomaret/pages/customers/">Customers</a>
        <a href="/indomaret/pages/suppliers/">Suppliers</a>
    </div> -->
    <section class="md:px-10 px-4 mt-5 md:mt-17 mx-1 md:ms-[250px]">