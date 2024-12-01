<style>
    .headerContainer{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        height: 100%;
        background-color: #FFFFFF;
    }
    .righHeaderContainer{
        display: flex;
        flex-direction: row;
        gap: 2rem;
        align-items: center;
        justify-content: end;

        & i {
            font-size: 1.5rem;
            color: #586F69;
        }
        .profileContainer{
            width: 200px;
            height: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            
        }

        .profilePicture{
            height: 3rem;
        }

        .profile-description{
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 7px 0 0 5px;
       

        }
        .name{
            margin: 0;
            display: flex;
            align-items: center;
            font-family: "Protest Strike", sans-serif;
        }
        .position{
            margin: 0;
            display: flex;
            align-items: center;
        }
    }

</style>
<div class="border headerContainer">
    <div >
        
    </div>
    <div class="righHeaderContainer">
        <i class="bi bi-star"></i>
        <i class="bi bi-bell"></i>
        <i class="bi bi-envelope"></i>
        <i class="bi bi-list-stars"></i>
        <div class="profileContainer" >
            <img class="profilePicture" src="public/images/profile/sample.jpg" alt="">
            <div class="profile-description">
                <p class="name">Ejhay Gofredo</p>
                <label class="position">Admin</label>
            </div>
        </div>
    </div>
</div>