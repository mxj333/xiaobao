<link rel="stylesheet" href="/css/demo.css" type="text/css">
<link rel="stylesheet" href="/css/zTreeStyle/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
  <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        data: {
            key: {
                title:"name"
            },
            simpleData: {
                enable: true
            }
        },
        callback: {
            onClick: zTreeOnClick
        }
    };
    var zNodes =[
        <?php foreach($tree as $colu) {?>
            { id:<?=$colu['id']?>, pId:<?=$colu['parent_id']?>, name:"<?=$colu['name']?>", open:true},
        <?php }?>
    ];

    function zTreeOnClick(event, treeId, treeNode) {
        var id = treeNode.tId;
        getList(id);
    };

    function getList(id){
        var id = id || 0;
        var htm = '';
        $.ajax({
            type:"GET",
            url:"/api/articles.json",
            data : {'page':id},
            dataType: 'json',
            async:false,
            success: function(json){
                console.log(json.pagination);
                var obj = json.data;
                for (var i = 0; i < obj.length; i++) {
                    htm += '<tr><td>' + obj[i].id + '</td>';
                    htm += '<td>' + obj[i].title + '</td>';
                    htm += '<td>' + obj[i].created + '</td>';
                    htm += '<td>查看|编辑|删除</td></tr>';
                }
                $("#listData").html(htm);

                $(".paginator .pagination").html('<li> sdfasf</li>');
            },
            error: function (json) {
                alert('error');
            }
        });
    }

    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        getList();
    });
    //-->
</SCRIPT>
<div class="zTreeDemoBackground left">
    <ul id="treeDemo" class="ztree"></ul>
</div>
