<?php
/**
 * Copyright 2019 Copyright (c) 2015 Hungersoft (http://www.hungersoft.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace HS\AdminReindex\Controller\Adminhtml\Indexer;

class Reindex extends \Magento\Backend\App\Action
{
    private $indexerFactory;

    private $logger;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Indexer\Model\IndexerFactory $indexerFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Indexer\Model\IndexerFactory $indexerFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->indexerFactory = $indexerFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {
            try {
                foreach ($indexerIds as $indexerId) {
                    $indexer = $this->indexerFactory->create();
                    $indexer->load($indexerId);
                    $indexer->reindexAll();
                }
                $this->messageManager->addSuccessMessage(__('Reindex %1 indexer(s).', count($indexerIds)));
            } catch (Exception $e) {
                $this->logger->critical($e);
                $this->messageManager->addErrorMessage(__('We couldn\'t reindex because of an error.'));
            }
        }

        $this->_redirect('indexer/indexer/list');
    }
}
