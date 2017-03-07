
set term png 
set output "plot.png"
set size 1.1,0.5
set pointsize .5
set xdata time 
set ylabel "Response Time (seconds)"
set yrange [0:]
set bmargin 2
set tmargin 2
set timefmt "%m %d %H %M %S %Y"
plot "plot.log" using 1:7 title "Response Times" w lines
