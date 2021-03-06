<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/21 0021
 * Time: 下午 5:35
 */

namespace DenDroGram\Model;


class AdjacencyListModel extends Model
{
    /**
     * @var string 
     */
    protected $table = 'dendrogram_adjacency';

    /**
     * @var bool 
     */
    public $timestamps = false;

    /**
     * @var array 
     */
    protected $guarded = ['id','p_id'];

    public static function getChildren($id)
    {
        $data = self::whereRaw("FIND_IN_SET(id,dendrogramAdjacencyGetChildren($id))")->orderBy('p_id', 'ASC')->orderBy('sort', 'DESC')->get();
        if(!$data){
            return [];
        }
        return $data->toArray();
    }
    
    public static function deleteAll($id)
    {
        return self::whereRaw("FIND_IN_SET(id,dendrogramAdjacencyGetChildren($id))")->delete();
    }
}