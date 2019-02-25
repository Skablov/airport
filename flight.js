const url = 'server.php';
window.onload = load();

function modal_windwow()
{
  let date = document.getElementById('date').value;
  if(check_data(date))
  {
    let name = document.getElementById('name').value;
    let select = document.getElementById('select').value;
    let type = document.getElementById('type').value;
    if(!isEmpty(name))
    {
      let params = 'command=add_pas&&name='+name+'&&select='+select+'&&type='+type+'&&date='+date;
      ajaxPost(url,params).then(resolve =>
      {
        alert(resolve);
      }).catch(reject =>
      {
        alert("Ошибка работы сервера");
        console.log(reject);
      });
    }
    else {
      alert("Вы не ввели имя!");
      return;
    }
  }
  else {
    alert("Ошибка в дате");
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
    let select = document.getElementById('select');
    for(let i = 0; i < resolve.length / 6; i++)
    {
      let option = document.createElement('option');
      option.innerHTML = resolve[(i * 6)];
      select.appendChild(option);
      let tr = document.createElement('tr');
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
function check_data(date) // проверка даты
{
  var now = new Date();
  let day = date[8] + date[9];
  let month = date[5] + date[6];
  let year = date[0] + date[1] + date[2] + date[3];

  if(day != null && month != null && year != null)
  {
    if(year > now.getFullYear())
    {
      return true;
    }
    else
    {
      if(year == now.getFullYear())
      {
        if(month > now.getMonth() + 1)
        {
          return true;
        }
        else
        {
          if(month == now.getMonth() + 1)
          {
            if(day > now.getDate())
            {
              return true;
            }
            else {
              return false;
            }
          }
          else {
            return false;
          }
        }
      }
      else {
        return false;
      }
    }
  }
  else {
    return false;
  }
}

function isEmpty(str) // проверка на пустоту
{
  if (str.trim() == '')
    return true;
  return false;
}
