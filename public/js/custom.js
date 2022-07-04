function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function showSubCategories(category_id, name, list){
    let menu = document.getElementById('sub_categories_menu');
    let elements = '';
    let sub_list = JSON.parse(list);
    if(sub_list.length>0){
        for(let index = 0; index<sub_list.length; index++){
            elements += "<li class='p-0 mt-0 mb-0 ms-3' onclick='window.location.href ="+"\""+sub_list[index]['name']+"\""+"'>"+ sub_list[index]['name'] +"</li><hr>";
        }
        elements += "<li class='p-0 mt-0 mb-0 ms-3' onclick='window.location ="+"\""+name+"\""+"'>"+ "All "+ name +"</li>";
    }else{
        elements += "<li class='p-0 mt-0 mb-0 ms-3' onclick='window.location ="+"\""+name+"\""+"'>"+ "All "+ name +"</li>";
    }
    menu.innerHTML = elements;
    menu.style.display = 'block';
}

