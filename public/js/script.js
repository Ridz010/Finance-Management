const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.querySelector(".theme-toggle").addEventListener("click",() => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass(){
    const current = document.documentElement.getAttribute('data-bs-theme');
    const inverted = current == 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme',inverted);
}

function toggleLocalStorage(){
    if(isLight()){
        localStorage.removeItem("light");
    }else{
        localStorage.setItem("light","set");
    }
}

function isLight(){
    return localStorage.getItem("light");
}

if(isLight()){
    toggleRootClass();
}

document.addEventListener("DOMContentLoaded", function () {
    const pemasukanButton = document.getElementById('pemasukanButton');
    const pengeluaranButton = document.getElementById('pengeluaranButton');

    pemasukanButton.addEventListener('click', function () {
        fetch('/pemasukan')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.content .container-fluid').innerHTML = data;
            });
    });

    pengeluaranButton.addEventListener('click', function () {
        fetch('/pengeluaran')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.content .container-fluid').innerHTML = data;
            });
    });
});
