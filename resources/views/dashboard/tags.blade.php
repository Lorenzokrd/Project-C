@include('include.dashboard.header')
<body>
<div class="category-table">
    <h1>Tags</h1>
    <span class="delivery-times-hint">Maximaal vier tags selecteren</span>
    <div class="row">
        <div class="col-lg-4">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#tags-overview" aria-expanded="true" aria-controls="collapseExample">
            Tags overzicht
        </button>
        </div>
    </div>
    <br>
    <div id ="chosenTagsBadges" class="badgesDiv row">
    </div>
    <hr>
    <div class="collapse row" id="tags-overview" style="margin-left: 0px;">
            <table class="table table-striped">
                <thead class="thead-black">
                <tr>
                    <th scope="col">Tag naam</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id = "tagsTableBody">
                    @foreach($tags as $tag)
                    <tr>
                        <td class={{$tag->id}}><a href="#">{{$tag->name}}</a></td>
                        <td class={{$tag->id}}><i class="plus-icon fas fa-plus" aria-hidden="true"></i></td>
                    </tr>
                    @endforeach
                </tbody>  
            </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        //defining all needed global variables
        var chosenTags = [];
        var currentRestaurantTagsAmount = '<?php echo count($tagsCurrentRestaurant)?>';
        var currentRestaurantTags = <?php echo json_encode($tagsCurrentRestaurant)?>;
        var allTags = <?php echo json_encode($tags)?>;
        var tagsTable = document.getElementById("tagsTableBody");
        var numberOfAttachedTags = 0;
        toastr.options.timeOut = 1000;
        //adding the badges for the chosen tags
        for(var i =0;i<currentRestaurantTags.length;i++){
            addSingleBadge(currentRestaurantTags[i]["id"],currentRestaurantTags[i]["name"]);
        }
        //get the number of chosen tags
        $.get("tags/chosenTags",function(data, textStatus, jqXHR){
            numberOfAttachedTags = data["tagsCurrentRestaurant"].length;
        });
        //functionality to deattach a tag
        $(".delete-tag").on('click',function(){
            $.ajax({
                type:"post",
                url: "/dashboard/tags/RemoveTag",
                data: {id:$(this).attr("id"), _token: '{{csrf_token()}}'},
                success: function(data) {
                    $(".badgeHead"+data["deletedTagId"]).hide();
                    toastr.success(data["status"]);
                    currentRestaurantTags = data["tags"];
                    numberOfAttachedTags--;
                },
                error: function (data, textStatus, errorThrown) {
                    toastr.error(data["status"]);
                },
            });
        })
        //functionality to add a tag
        $("td").click(function(){
            if(isChosen($(this).attr("class")) ){
                toastr.error("Tag is al door u geselecteerd");
            }
            else if(tagIsChosen(currentRestaurantTags,$(this).attr("class"))){
                toastr["error"]("Tag is al door u geselecteerd!");
            }
            else{
                if(numberOfAttachedTags>=4){
                    toastr["warning"]("Het maximale aantal tags is bereikt");
                }
                else{
                    $.ajax({
                        type: "post",
                        url: '/dashboard/tags/addTagToRestaurant',
                        data: { tagId: $(this).attr("class"), _token: '{{csrf_token()}}' },
                        success: function (data) {
                            chosenTags.push($(this).attr("class"));
                            toastr.success(data["status"]).delay(1000);
                            addSingleBadge(data["addedTagId"],data["addedTagName"]);
                            numberOfAttachedTags++;
                            location.reload();
                        },
                        error: function (data, textStatus, errorThrown) {
                            toastr.error(data["status"]);
                        },
                    }); 
                }
            }
        });
        //check if tag is already chosen
        function isChosen(tagId){
            for(var i = 0;i<chosenTags.length;i++){
                if(chosenTags[i]==tagId){
                    return true;
                }
            }
        };
        //check if tag is chosen using data from db
        function tagIsChosen(arrayToCheck,tagId){
            for(var i = 0; i<arrayToCheck.length;i++){
                if(tagId == arrayToCheck[i]['tag_id']){
                    return true;
                }
            }
        };
        //adds single tag badge
        function addSingleBadge(chosenTagId,chosenTagName){
            var chosenTagsBadgesDiv = document.getElementById("chosenTagsBadges")
            var badgeHead = document.createElement("h4");
            var badgeSpan = document.createElement("span");
            var deleteIcon = document.createElement("i");
            badgeSpan.className = "tag-badge badge badge-pill badge-success";
            badgeSpan.innerText = chosenTagName;
            deleteIcon.id = chosenTagId;
            deleteIcon.className = "delete-tag fas fa-times fa-xs";
            badgeHead.className = "badgeHead"+chosenTagId;
            badgeSpan.appendChild(deleteIcon);
            badgeHead.appendChild(badgeSpan);
            $("#chosenTagsBadges").append(badgeHead)
        }
        })
</script>
</body>

@include('include.dashboard.footer')
