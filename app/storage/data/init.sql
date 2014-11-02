CREATE TABLE `lottery_winners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lottery_id` int(11) NOT NULL,
  `lottery_round` int(11) NOT NULL DEFAULT '1',
  `lottery_winners` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lotterys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '奖次名称',
  `gift` varchar(100) NOT NULL DEFAULT '' COMMENT '奖品',
  `maxrounds` int(11) NOT NULL DEFAULT '1'COMMENT '本轮抽奖次数',
  `runround` int(11) NOT NULL DEFAULT '0' ,
  `roundwinners` int(11) NOT NULL DEFAULT '1' COMMENT '每轮人数',
  `isDeleted` int(11) NOT NULL DEFAULT '0' COMMENT '删除标记,1 标记为已删除 ',
  `isOpened` int(11) NOT NULL DEFAULT '0' COMMENT '开放标记,0 未开放 1 已开放 2 已结束',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
