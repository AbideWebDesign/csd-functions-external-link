jQuery((function(t){var e=["csd509j.net","https://teachcorvallis.org","https://www.parentsquare.com"];console.log("made it"),t('a[href^="http"]').on("click",(function(r){var a=t(this).attr("href");void 0===e.find((function(t){var e=new RegExp(t);return null!==a.match(e)}))&&(r.preventDefault(),t("#externalLink").attr("href",t(this).attr("href")),t("#modalNotification").modal("show"))}))}));