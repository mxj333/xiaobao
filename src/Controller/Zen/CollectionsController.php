<?php
namespace App\Controller\Zen;
use App\Controller\Zen\AppController;
use MajaLin\Webbot\DownloadImages;
use MajaLin\Webbot\Parse as MS_Parse;

/**
 * Collections Controller
 *
 */
class CollectionsController extends AppController {

    public $uses = false;

    public function initialize() {
        parent::initialize();
        $this->set('art_status', [1 => '发布', 0 => '草稿', 8 => '采集']);
    }

    public function index() {
        //要采集的网站
        $this->set('source_website', [
            'wechat' => '采集微信文章',
            // 'winbaoxian' => '微易保险师文章',
        ]);

        $this->loadModel('Articles');
        $this->loadModel('Columns');
        $columns = $this->Columns->find('treeList');

        $condition = [];
        $column_id = $this->request->params['pass'] ? intval($this->request->params['pass'][0]) : 0;
        if ($column_id) {
            $condition['column_id'] = $column_id;

        }
        $condition['art_status'] = 8;
        $this->paginate = array(
            'conditions' => $condition,
            'page' => $this->params['page'],
            'limit' => 20,
            'order' => array(
                'Articles.id' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('columns', 'articles', 'column_id'));
        $this->set('_serialize', ['columns', 'articles']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        @header('Content-type: text/html;charset=UTF8');
        // require_once ROOT . DS . 'vendor' . DS . "Gather.php";
        $this->loadModel('Articles');
        $article = $this->Articles->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $target = $this->request->data['url'];
            $param = trim($this->request->data['param']);

            switch ($param) {
            case 'wechat':
                $res = wechat($target);
                $res['art_cover'] = '';
                // $res['title'] = strip_tags($res['title'], '');
                // var_dump($res);exit;
                break;

            case 'winbaoxian':
                $res = $this->winbaoxian($target);
                // var_dump($res);exit;
                break;

            default:
                # code...
                break;
            }

            if ($res) {
                // $thumb = autoThumb($res['content']);
                // // var_dump($thumb);
                // $res['art_cover'] = $thumb['name'];
                // $res['art_cover_path'] = $thumb['path'];
                // exit;

                $data['column_id'] = 1;
                $data['art_status'] = 8;
                $data['art_title'] = substr($res['title'], 8);
                // $data['art_url_alias'] = getShortTitle(strtolower(pinyin($res['title'], 1)), 30);
                $data['art_body'] = $res['content'];
                $data['art_source'] = $res['nickname'];

                if (!empty($res['art_cover'])) {
                    $data['art_cover'] = $res['art_cover'];
                    $data['art_cover_path'] = $res['art_cover_path'];
                }

                // var_dump($data);
                // exit;
                $article = $this->Articles->patchEntity($article, $data);
                // var_dump($article);
                // exit;
                if ($result = $this->Articles->save($article)) {
                    // var_dump($result->art_cover);exit;
                    $this->Flash->success(__('Your article has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
        $this->set('param', $this->request->params['pass'][0]);

    }

    /**
     * winbaoxian method
     * 采集微易保险师内容
     */
    public function winbaoxian($target) {
        if (empty($target)) {
            return false;
        }

        $content = json_decode(file_get_contents("$target"), true);

        $res['title'] = $content['data']['shareNewsInfo']['learningNewsInfo']['title'];
        if ($res['title']) {
            // $res['content'] = $content['data']['shareNewsInfo']['learningNewsInfo']['thumbnails'];
            $res['nickname'] = '微易保险师';
            $image_url = $content['data']['shareNewsInfo']['learningNewsInfo']['thumbnails'][0];
            $cover = $this->downloadImages("$image_url");
            $res['art_cover'] = $cover['image_name'];
            $res['art_cover_path'] = $cover['save_image_directory'];

            $res['content'] = $this->saveRemoteImages($content['data']['shareNewsInfo']['learningNewsInfo']['artContent']);

            return $res;exit;
        }
        return false;
    }

    //下载图片到本地
    public function downloadImages($image_url, $is_thumbnail = 1, $save_image_directory = '') {

        // 获取远程图片
        $dowImg = new DownloadImages();
        $this_image_file = $dowImg->download_binary_file($image_url, 'http://app.winbaoxian.com');

        //保存路径
        $save_image_directory = $save_image_directory ? $save_image_directory : './files' . DS . 'Articles' . DS . 'art_cover' . DS . date('Y') . DS . date('md');

        //创建保存目录
        $dowImg->mkpath($save_image_directory);

        $image_name = explode('/', $image_url);
        $image_path = $image_name[count($image_name) - 1];

        // 数据表保存的图片名称
        $res['image_name'] = $image_path;

        //是否为缩略图
        if ($is_thumbnail) {
            $image_path = 'thumbnail-' . $image_path;
        }

        // 保存图片
        if (stristr($image_url, ".jpg") || stristr($image_url, ".gif") || stristr($image_url, ".png") || stristr($image_url, ".jpeg")) {
            $fp = fopen($save_image_directory . DS . $image_path, "w");
            fputs($fp, $this_image_file);
            fclose($fp);
            echo "\n";
        }

        // 保存图片的目录
        $res['save_image_directory'] = 'webroot' . substr($save_image_directory, 1);

        return $res;

    }

    //从文章内容中保存远程图片，并替换路径
    public function saveRemoteImages($body) {

        $parse = new MS_Parse();

        //取出文章内容中的图片
        $img_tag_array = $parse->parse_array($body, "<img", ">");

        if (count($img_tag_array) == 0) {
            return $body;
            exit;
        }

        $image_path = './ueditor' . DS . 'php' . DS . 'upload' . DS . 'image' . DS . date('Ymd');
        for ($xx = 0; $xx < count($img_tag_array); $xx++) {

            //取出文章内容中的图片路径
            $image_url = $parse->get_attribute($img_tag_array[$xx], $attribute = "src");

            //下载到本地
            $image = $this->downloadImages($image_url, 0, $image_path);

            //替换为本地路径
            $body = str_replace($image_url, substr($image['save_image_directory'], 7) . '/' . $image['image_name'], $body);
        }

        //只保留图片中的 src其他属性全部去掉
        $body = preg_replace('/<img.+?src=\"(.+?)\".+?>/', '<img src="\1" >', $body);
        return $body;
    }

}
