function XMLHttpRequestInit(body, addr)
{
    var xhr = new XMLHttpRequest();
    var body = body;
    xhr.open("POST", addr, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);
    return xhr;
}

function ajax_add_comment()
{
    var comment = document.getElementById("comment").value;
    if(!comment)
    {
        alert("Вы не написали комментарий");
        return;
    }

    var id = document.getElementById("btn-add-comm").getAttribute("data-id");
    var url = "/news/addCommentAjax/"+id;
    var body = "comment="+comment;
    var xhr = XMLHttpRequestInit(body, url);

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status==200)
        {
            var res = JSON.parse(xhr.responseText);
            for(text in res)
            {
                var parentEl = document.getElementById("table1");
                var row = parentEl.insertRow(1);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = res[text].text;
                cell1.ClassName = '';
            }
        }
    }
}

function ajax_add_news()
{
    var title = document.getElementById("title").value;
    var text = document.getElementById("text").value;
    var date = new Date(document.getElementById("date").value).getTime() / 1000;
    if(!title || !text || !date)
    {
        alert("Вы заполнили не все поля");
        return;
    }

    var url = '/admin/add';
    var body = "title="+title+"&text="+text+"&date="+date;
    // initialize xmlHttp request
    var xhr = XMLHttpRequestInit(body, url);

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status==200)
        {
            var res = JSON.parse(xhr.responseText);

            for(text in res)
            {//display added news to the begin of table
                var parentEl = document.getElementById("news");
                var row = parentEl.insertRow(1);
                var cellDate = row.insertCell(0);
                cellDate.rowSpan = 2;
                var celltitle = row.insertCell(1);
                var cellEdit = row.insertCell(2);
                cellEdit.rowSpan = 2;
                var row2 = parentEl.insertRow(2);
                var cellText = row2.insertCell(0);
                cellDate.innerHTML = toDateTime(res[text].date);// parse to short date like php
                celltitle.innerHTML = "<a href=/news/"+res[text].id+"><h3>"+res[text].title+"</h3></a>";
                cellEdit.innerHTML ="<a href=/admin/view/"+res[text].id+"><h3>Редактировать</h3></a>";
                cellText.innerHTML = res[text].text;
            }
        }
    }
}
//convert seconds to date
function toDateTime(secs)
{
    var t = new Date(1970, 0, 1);
    t.setSeconds(secs);
    return t.getFullYear()+"/"+(t.getMonth()+1)+"/"+t.getDate();
}
//ajax request o delete news
function ajax_delete_news()
{
    var id = document.getElementById("btn-delete-news").getAttribute("data-id");

    var xhr = XMLHttpRequestInit("", '/admin/delete/'+id);

    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status==200)
        {
            alert("Данные удалены");
            window.location.href = '/admin/index';
        }
    }
}
// ajax request to edit news by id
function ajax_edit_news()
{
    var id = document.getElementById("btn-edit-news").getAttribute("data-id");
    var title = document.getElementById("title").value;
    var text = document.getElementById("text").value;
    var date = new Date(document.getElementById("date").value).getTime() / 1000;
    if(!title || !text || !date)
    {
        alert("Вы заполнили не все поля");
        return;
    }
    // initialize xmlHttp request
    var xhr = XMLHttpRequestInit("title="+title+"&text="+text+"&date="+date,'/admin/edit/'+id);
    xhr.onreadystatechange = function()
    {
        if(xhr.readyState == 4 && xhr.status==200)
        {
            alert("Данные изменены");
        }
    }
}