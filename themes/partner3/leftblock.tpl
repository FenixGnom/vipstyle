<div class="contentLeft left">
        <div class="contentLeftTop"></div>
        <div class="contentLeftCenter">
                <span>  Наши футболки :</span>
                <div class="categoriesMenuBlock center">
                        {include file='category.tpl'}
                </div>
        </div>
        <div class="contentLeftBottom"></div>
        <div class="contentSearchTop"></div>
        <div class="contentSearchCenter">
                <div class="searchBlock center">
                        <form name="filter" method=post action="/search/">
                                <input name="find" type="text" value="" class="left inputSearch" value="поиск по названию" onClick="this.value='';">
                                <input type="submit" value="Поиск" class="left buttonSearch">
                                <input type="hidden" name="act" value="search">
                        </form>
                </div>
        </div>
        <div class="contentSearchBottom"></div>
        <div class="contentLeftCenter">
                <span>  Контакты:</span>
                <div class="categoriesMenuBlock center">
                        {if $template_data->partner()->contact_icq() != ""}
                        <div class="infoMenu"><b>ICQ:</b> {$template_data->partner()->contact_icq()}</div>
                        {/if}
                        {if $template_data->partner()->contact_email() !=""}
                        <div class="infoMenu"><b>email:</b> <a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a></div>
                        {/if}
                        {if $template_data->partner()->contact_phone() !=""}
                        <div class="infoMenu"><b>Телефон: </b>{$template_data->partner()->contact_phone()}</div>
                        {/if}
                        <div class="infoMenu"> <a href="/feedback">Обратная связь</a></div>

                </div>
                <div class="contentLeftBottom"></div>
        </div>
</div>
<div class="contentRight left">
