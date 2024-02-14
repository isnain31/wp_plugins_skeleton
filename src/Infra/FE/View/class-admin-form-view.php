<?php
namespace Movie_Data\Infra\FE\View;
class Admin_Form_View
{
    public static function create(array $data=[]): void
    {
        $movie_data_nonce = wp_create_nonce( 'movie_data_nonce' );
        ?>
        <div id="movie_data_form_feedback"></div>
        <h1>Movie Data</h1>
        <br>
        <form method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>" id="movie_data_form" >
            <input type="hidden" name="action" value="movie_data" />
            <input type="hidden" name="movie_data_nonce" value="<?php echo $movie_data_nonce ?>" />
            <div>
                <br>
                <label for="title">Title</label>
                <br>
                <input type="text" name="title"/>
                <br>
            </div>
            <div>
                <br>
                <label for="starring">Starring</label>
                <br>
                <textarea name="starring"></textarea>
                <br>
            </div>
            <p class="submit">
                <input type="submit" value="Save" />
            </p>
        </form>
       <?php
    }
}