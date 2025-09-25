import { timeAgo } from "./utils";

let App = {
    common: {
        init: function () {
            console.log("Common script is running on all pages");
        }
    },
    cashiers: {
        init: function () {
            console.log("Script for cashiers page is running");
        }
    },
    products: {
        init: function () {
            console.log("Script for products page is running");
        }
    }
}

$(function () {
    App.common.init();

    let page = $("body").data("page");
    if (App[page] && typeof App[page].init() === "function") {
        App[page].init();
    }
})