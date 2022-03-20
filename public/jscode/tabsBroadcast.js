function newSearchIsPerformed(key) {
    localStorage.setItem(key, "");
    localStorage.removeItem(key);
}

function new_hotel_search_method(){

    return  closePages = [
        'hotels/search',
        'hotels/items',
    ];

}

function new_flights_search_method(){

    return  closePages = [
        'flights/search',
        'flights/items',
    ];

}

function closeTabsAfterSearch(ev) {

    const allowedConds = ['new_hotel_search', 'new_flight_search'];

    if (allowedConds.includes(ev.originalEvent.key) == false) return;

    let closePages = window[ev.originalEvent.key+"_method"]();

    const currentUrl = window.location.href;

    for (let closePageKey in closePages) {

        let closePage = closePages[closePageKey];

        if (currentUrl.includes(closePage)) {
            window.location.href = base_url2+"?show_flash_msg=you can not open search page twice";
        }

    }

}

$(function () {

    $(window).on('storage', closeTabsAfterSearch);

});
