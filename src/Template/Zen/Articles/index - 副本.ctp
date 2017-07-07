
    <link rel="stylesheet" href="/css/demo.css" type="text/css">
    <link rel="stylesheet" href="/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
    <!--  <script type="text/javascript" src="../../../js/jquery.ztree.excheck-3.5.js"></script>
      <script type="text/javascript" src="../../../js/jquery.ztree.exedit-3.5.js"></script>-->
    <SCRIPT type="text/javascript">
        <!--
        var setting = {
            async: {
                enable: true,
                url:"/articles/columns.json",
                autoParam:["id", "name=n", "level=lv"],
                otherParam:{"otherParam":"zTreeAsyncTest"},
                dataFilter: filter
            }
        };

        function filter(treeId, parentNode, childNodes) {
            if (!childNodes) return null;
            var childNodes = childNodes['json']
            for (var i=0, l=childNodes.length; i<l; i++) {
                childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
            }
            return childNodes;
        }

        $(document).ready(function(){
            $.fn.zTree.init($("#treeDemo"), setting);
        });
        //-->
    </SCRIPT>
<div class="content_wrap">
    <div class="zTreeDemoBackground left">
        <ul id="treeDemo" class="ztree"></ul>
    </div>

</div>
