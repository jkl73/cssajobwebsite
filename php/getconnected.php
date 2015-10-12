<!DOCTYPE HTML>
<head>
 <title>Cornell CSSA Jobs site</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<style>

.node {
  stroke: #ccc;
}

.node text {
  pointer-events: none;
  font: 10px sans-serif;
}

.link {
  stroke: #999;
  stroke-opacity: .6;
}

.circle {
  border: 6;
}

</style>

</head>

<body>
<?php
  include("./header.php");
?>


<script>
var width = $(window).width(),
    height = $(window).height()

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);

var force = d3.layout.force()
    .gravity(.2)
    .distance(140)
    .charge(-2000)
    .size([width, height]);

d3.json("../data/miserables.json", function(error, json) {
  if (error) throw error;

  force
      .nodes(json.nodes)
      .links(json.links)
      .start();

  var link = svg.selectAll(".link")
      .data(json.links)
    .enter().append("line")
      .attr("class", "link");

  var node = svg.selectAll(".node")
      .data(json.nodes)
    .enter().append("g")
      .attr("class", "node")
      .call(force.drag);

  node.append("rect")
      .attr("x", -25)
      .attr("y", -25)
      .attr("rx", "50%")
      .attr("width", 70)
      .attr("fill", "url(.imgPattern)")
      .attr("height", 70);

  node.append("pattern")
      .attr("class", "imgPattern")

  var nodeimg = svg.selectAll(".imgPattern")

  nodeimg.append("image")
      .attr("xlink:href", "../pictures/shuai.jpg")



  node.append("text")
      .attr("dx", -12)
      .attr("dy", 25)
      .text(function(d) { return d.name });

  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
  });
});

</script>


<?php
  include("./footer.php");
?>
</body>