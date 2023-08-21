<?php

    declare(strict_types=1);

    namespace  Droxic\InsuranceClaimForm\Model\Resolver;

    use Magento\Framework\GraphQl\Exception\GraphQlInputException;
    use Magento\Framework\GraphQl\Config\Element\Field;
    use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
    use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
    use Magento\Framework\GraphQl\Query\ResolverInterface;
    use Droxic\InsuranceClaimForm\Model\ResourceModel\Claim\CollectionFactory;
    use Magento\Customer\Model\Session;
    use Droxic\InsuranceClaimForm\Model\ClaimFactory;
    use Droxic\InsuranceClaimForm\Model\Claim;
    
    class UpdateClaimStatus implements ResolverInterface
    {
       protected $collection;

       protected $claimFactory;

       protected $session;
       public function __construct(
            CollectionFactory $collectionFactory,
            ClaimFactory $claimFactory,
            Session $session
        ) {
            $this->collection = $collectionFactory;
            $this->session = $session;
            $this->claimFactory = $claimFactory;
        }
       public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
        {
            if(!$this->session->isLoggedIn()) {
                return ['status' => 'user is not logged in'];
             }
             
            $data = [
                'claim_user_id' => $this->session->getCustomer()->getId(),
                'claim_firstname' => $args['firstname'],
                'claim_lastname' => $args['lastname'],
                'claim_ins_id' => $args['insuranceId'],
                'claim_category' => $args['category'],
                'claim_damage_description' => $args['damagedescription'],
                'claim_status' => 1
            ];
            $claimModel = $this->claimFactory->create();
            $claimModel->setData($data)->save();

            return [
                'status' => Claim::STATUSES[1]
            ];

           
            //$this->collection->create();
            // filter by firstname lastname ins Id
            // get one or first record
            // return status from this record

            // if there is no record return default text

            //var_dump($args['firstname']);
            //die;
            //return ["status" => "non existing"];

            // 1 Received
            // 2 Proccesssing
            // 3 Declined
            // 4 Approved
            // 5 Finished

            // use session
            // $session->isLoggedIn()
            // $session->getCustomer()->getId()
        }
       
    }