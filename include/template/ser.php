<div class="col-lg-9">
    <div class="heading">
    search <i class="fa fa-search"></i>
    </div>
    <div class="bodyheading">
        <div class="container">
            <form action="search.php" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="sage">الحد الادني</label>
                        <select name="minage" id="sage" class="form-control">
                            <option value="0">الحد الادني</option>
                            <?php
                            for ($i = 18; $i <= 50; $i++) {
                            ?>
                                <option value="<?php echo $i; ?>"> <?php echo $i . " Years"; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="city">المدينه</label>
                        <select name="city" id="city" class="form-control">
                            <option value="0">المدينه</option>
                            <option value="1">القاهره</option>
                            <option value="2">الاسكندريه</option>
                            <option value="3">الجيزه</option>
                            <option value="4">المنوفيه</option>
                            <option value="5">اسيوط</option>
                            <option value="6">قنا</option>
                            <option value="7">سوهاج</option>
                            <option value="8">اسوان</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="eage">الحد الاقصي</label>
                        <select name="maxage" id="eage" class="form-control">
                            <option value="0">الحد الاقصي</option>
                            <?php
                            for ($i = 19; $i <= 50; $i++) {
                            ?>
                                <option value="<?php echo $i; ?>"> <?php echo $i . " Years"; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="soc">الحاله الاجتماعيه</label>
                        <select name="sociallife" id="soc" class="form-control">
                            <option value="0">الحاله الاجتماعيه</option>
                            <option value="1">اعزب</option>
                            <option value="2">متزوج/ه</option>
                            <option value="3">ارمل/ه</option>
                        </select>
                    </div>
                </div>
        </div>
        <input type="submit" value="search" class="sub btn btn-info" name="serwithselect">
        </form>
    </div>
</div>











