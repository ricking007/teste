url = window.location.href;
pathname = new URL(url).pathname;
arr = pathname.split('/');

baseurl = arr[1] + "/";
if (baseurl === "gapm/") {
    baseurl = arr[3] + "/";
}