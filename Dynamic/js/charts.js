$(window).load(function(){
	var ForReading=1; 
    if($("#chart-4").length > 0){
        var data = [], totalPoints = 300;	//数据总数
        var updateInterval = 100;   //扫面时间  单位ms
        var plot = $.plot($("#chart-4"), [ getData() ], {
            series: { shadowSize: 0 }, //线阴影
            yaxis: { min: 0, max: 100 },
            xaxis: { show: true }  //背景网格
        });
        update(); 
    }
    function update() {

        plot.setData([ getData() ]);
        // since the axes don't change, we don't need to call plot.setupGrid()
        plot.draw();
        setTimeout(update, updateInterval);
    }
    function getData() {
        if (data.length > 0)
            data = data.slice(1);

        // do a random walk
        while (data.length < totalPoints) {
            var y = Math.random()*50;
			//document.write(y+"\n");
            if (y < 0)
                y = 0;
            if (y > 100)
                y = 100;
            data.push(y);
        }
		
        // zip the generated y values with the x values
        var res = [];
        for (var i = 0; i < data.length; ++i)
            res.push([i, data[i]])
        return res;
    }
	//指定位置显示
    function showTooltip(x, y, contents) {
        $('<div class="ct">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y,
            left: x + 10,
            border: '1px solid #000',
            padding: '3px',
            opacity: '0.7',
            'background-color': '#000',            
            color: '#fff'            
        }).appendTo("body").fadeIn(200);
    }    

    var previousPoint = null;
    
});
