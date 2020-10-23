/***************************************************************************
*
* SCRIPT JS
*
***************************************************************************/

$(document).ready(function () {
    if($('#jqChart').length){
      $.get("dashboard/getalltotalbyyear", function(data){
        // var a = data;
        var data = JSON.parse(data);
          renderChart(data);
      });
      $('#totalbyyear').click(function(){
          var year = $('.chosen_year').val();
          $.ajax({
                  type: "POST",
                  url: BASE_URL + "dashboard/getalltotalbyyear",
                  dataType: 'json',
                  data: {'year': year},
                  success: function (res) {
                    console.log('das');
                      if (res != null) {
                          renderChart(res);

                      } else
                      console.log('error');

                  }
              });
      });
    }


    function renderChart(data){
      $('#jqChart').jqChart({

          title: "Biểu Đồ Số Lượng Sản Phẩm Bán Ra Theo Năm",
          legend: {
              itemsCursor: 'pointer'
          },
          animation: { duration: 1 },
          series:[{
              type: 'column',
              title: data.year,
              data: [['Tháng 1', Number(data.data[1]) ],
                     ['Tháng 2', Number(data.data[2])],
                     ['Tháng 3', Number(data.data[3])],
                     ['Tháng 4', Number(data.data[4])],
                     ['Tháng 5', Number(data.data[5])],
                     ['Tháng 6', Number(data.data[6])],
                     ['Tháng 7', Number(data.data[7])],
                     ['Tháng 8', Number(data.data[8])],
                     ['Tháng 9', Number(data.data[9])],
                     ['Tháng 10',Number(data.data[10])],
                     ['Tháng 11',Number(data.data[11])],
                     ['Tháng 12',Number(data.data[12])],
                    ]
          }]
      });
    }


});
