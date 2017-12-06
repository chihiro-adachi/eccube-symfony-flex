<?php

namespace Eccube;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class EccubeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    /**
     * Allow an extension to prepend the extension configurations.
     */
    public function prepend(ContainerBuilder $container)
    {
        // doctrine.yamlの設定情報を取得
        $configs = $container->getExtensionConfig('doctrine');

        // processorで正規化
        $config = $this->processConfiguration(new Configuration(false), $configs);

        // dbalでdbアクセス
        $conn = \Doctrine\DBAL\DriverManager::getConnection($config['dbal']);
        // TODO booleanの判定が必要なのでquery builderにする
        $stmt = $conn->query('select * from dtb_plugin where enable = 1');
        $plugins = $stmt->fetchAll();

        // mapping情報の構築
        $mappings = [];
        foreach ($plugins as $plugin) {
            $code = $plugin['code'];
            $namespace = sprintf('Plugin\%s\Entity', $code);
            $mappings[$code] = [
                'is_bundle' => false,
                'dir' => '%kernel.project_dir%/app/plugins/'.$code.'/Entity',
                'prefix' => $namespace,
                'alias' => $code,
            ];
        }
        // mapping情報の追加
        if (!empty($mappings)) {
            $container->prependExtensionConfig('doctine', [
                'orm' => [
                    'mappings' => $mappings,
                ],
            ]);
        }
    }
}