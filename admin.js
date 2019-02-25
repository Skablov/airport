const url = 'server.php';
window.onload = load();


function modal_window()
{
  let dep = document.getElementById('dep').value;
  let ari = document.getElementById('ari').value;
  let time_d = document.getElementById('time_d').value;
  let time_a = document.getElementById('time_a').value;
  let number = document.getElementById('number').value;

  if(!isEmpty(dep) && !isEmpty(ari) && !isEmpty(time_d) && !isEmpty(time_a) && !isEmpty(number))
  {
    let params = 'command=add_fl&&dep='+dep+'&&ari='+ari+'&&time_d='+time_d+'&&time_a='+time_a+'&&number='+number;
    ajaxPost(url,params).then(resolve =>
    {
      alert(resolve);
      load();
    }).catch(reject =>
    {
      alert("Ошибка работы сервера");
      console.log(reject);
    })
  }
  else {
    alert("Вы что-то не заполнили");
    return;
  }
}

function load()
{
  let params = 'command=read';
  ajaxPost(url,params).then(resolve =>
  {
    resolve = JSON.parse(resolve);
    let tbody = document.getElementById('tbody');
    tbody.innerHTML = ' ';
    for(let i = 0; i < resolve.length / 6; i++)
    {
      let tr = document.createElement('tr');
      tr.onclick = () =>
      {
        let answer = confirm("Вы желаете удалить это рейс?");
        if(answer)
        {
          let params = 'command=del&&id=' + resolve[(i * 6)];
          ajaxPost(url,params).then(resolve =>
          {
            alert(resolve);
            load();
          }).catch(reject =>
          {
            alert('Ошибка работы сервера');
            console.log(reject);
          });
        }
        else {
          return;
        }
      }
      tr.innerHTML = '<th>'+resolve[(i * 6)] + '</th><th>' + resolve[(i * 6) + 1] + '</th><th>'  + resolve[(i * 6) + 2] + '</th><th>'  + resolve[(i * 6) + 3] + '</th><th>'  + resolve[(i * 6) + 4] + '</th><th>'  + resolve[(i * 6) + 5] + '</th><th>';
      tbody.appendChild(tr);

    }
  }).catch(reject =>
  {
    alert('Ошибка работы сервера');
    console.log(reject);
  });
}

function ajaxPost(url, params)
{
	return new Promise(function(resolve, reject)
	{
		var request = new XMLHttpRequest;
		request.open('POST',url,true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8')
		request.addEventListener("load", function()
		{
			if(request.status < 400)
			{
				resolve(request.responseText);
			}
			else
			{
				reject(Error("Ошибка получения данных"));
			}
		});
		request.send(params);
	});
}

function isEmpty(str) // проверка на пустоту
{
  if (str.trim() == '')
    return true;
  return false;
}
