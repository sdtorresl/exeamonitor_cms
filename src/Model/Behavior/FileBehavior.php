<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Database\Type;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Log\Log;

class FileBehavior extends Behavior
{
    public function initialize(array $config): void
    {
        $this->setConfig($config);

        Type::map('upload.file', 'App\Database\Type\FileType');
        $schema = $this->_table->getSchema();
        foreach (array_keys($this->getConfig()) as $field) {
            $schema->setColumnType($field, 'upload.file');
        }
        $this->_table->setSchema($schema);
    }

    /**
     * Return a folder path to store the files of the class, creates the folder if it doesn't exists
     * @return string 
     */
    protected function getRootFolder() {
        $path = WWW_ROOT . DS . 'files' . DS . $this->_table->getTable();
        $folder = new Folder();
        
        if($folder->create($path)) {
            $folder->cd($path);
        }
        return $folder->path;
    }

    /**
     * Get a unique filename for the file with the extension
     * @return string
     */
    protected function getFileName(EntityInterface $entity, string $field, string $name) {
        Log::debug("Entity: " . debug($entity));
        return $entity->id . '-' . $field . '-' . strtolower($name);
    }

    protected function fileize(EntityInterface $entity)
    {
        $config = $this->getConfig();
        foreach ($config as $field => $settings) {
            $file = $entity->get($settings['file']);

            if (is_string($file)) {
                continue;
            }

            if (empty($file)) {
                continue;
            }

            if ($file->getError() !== UPLOAD_ERR_OK) {
                $entity->set($field, $entity->getOriginal($field));
                $entity->setDirty($field, false);
                continue;
            }

            $fileName = $this->getFileName($entity, $field, $file->getClientFilename());
            $fileDir = $this->getRootFolder();
            $fileType = $file->getClientMediaType();
            $file->moveTo($this->getRootFolder() . DS . $fileName);

            $entity->set($settings['file'], $fileName);
            $entity->set($settings['file_type'], $fileType);
            $entity->set($settings['file_dir'], $fileDir);
        }
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->fileize($entity);
    }

    public function afterDelete(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        $config = $this->getConfig();

        foreach ($config as $field => $settings) {
            $file = new File($entity->get($settings['file_dir']) . DS . $entity->get($settings['file']));
            if ($file->exists()) {
                try {
                    $file->delete();
                } catch (\Throwable $th) {
                    Log::error("Can't delete file " . $entity->get($settings['file']));
                    Log::error($th->getMessage);
                }
            }
        }
    }
}
