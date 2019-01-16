
All URL Methods
===============

### COMPLETED
-------------
`/DocuWare/Platform/FileCabinets?orgid={orgid}`
  - Platform.php
`/DocuWare/Platform/FileCabinets/{fileCabinetId}`
  - FileCabinet.php
`/DocuWare/Platform/Organizations/{id}`
  - Organization.php
`/DocuWare/Platform/Organizations/{id}/Dialogs?dialogType={dialogType}`
  - Organization.php
`/DocuWare/Platform/Organizations/{id}/Dialogs`
  - Organization.php
`/DocuWare/Platform/Organizations/{id}/Group?groupId={groupId}`
  - Organization.php
`/DocuWare/Platform/FileCabinets/{fileCabinetId}/Dialogs?dialogType={dialogType}`
  - FileCabinet.php
`/DocuWare/Platform/FileCabinets/{fileCabinetId}/Dialogs/{id}`
  - FileCabinet.php

`/DocuWare/Platform/Organizations/{id}/Groups`
`/DocuWare/Platform/Organizations/{id}/GroupUsers?groupId={groupId}`
  - Organization->groups()

`/DocuWare/Platform/Organizations/{id}/Role?roleId={roleId}`
`/DocuWare/Platform/Organizations/{id}/Roles`
  - Organization->roles()

`/DocuWare/Platform/Organizations/{id}/SelectList?selectListId={selectListId}`
`/DocuWare/Platform/Organizations/{id}/SelectLists`
  - Organization->selectLists()

`/DocuWare/Platform/Organizations/{id}/SelectListValues?selectListId={selectListId}&start={start}&count={count}`  
`/DocuWare/Platform/Organizations/{id}/SelectListValues?selectListId={selectListId}`
  - Organization->selectListValues()

`/DocuWare/Platform/Organizations/{id}/UserByID?userId={userId}`
  - User->getById()
`/DocuWare/Platform/Organizations/{id}/UserGroups?userId={userId}`
  - User->groups()
`/DocuWare/Platform/Organizations/{id}/UserRoles?userId={userId}`
  - User->roles()
`/DocuWare/Platform/Organizations/{id}/Users?roleId={roleId}`
  - Organization->roleUsers()
`/DocuWare/Platform/Organizations/{id}/WebSettings` *GET*
  - Organization->webSettings()
`/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/Dialogs?orgId={orgId}`
  - Html->dialogs()
`/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/View?docId={docId}&sectionId={sectionId}`
  - Html->viewDocument()
`/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}` *GET*
  - Document->getData()
  `/DocuWare/Platform/Organizations/{id}/Users`
  - User->getAll()
  `/DocuWare/Platform/Account/LogOff`
  - Account->logOff()


### METHODS TO COMPLETE
-----------------------
/DocuWare/Platform/Account/ChangePassword?model={model}
/DocuWare/Platform/Account/ChangePasswordSuccess
/DocuWare/Platform/Account/CredentialValidation?model={model}
/DocuWare/Platform/Account/Disconnect?returnUrl={returnUrl}
/DocuWare/Platform/Account/LogOn?returnUrl={returnUrl}
/DocuWare/Platform/Account/LogOn?model={model}
/DocuWare/Platform/Account/LogOnGuest?returnUrl={returnUrl}
/DocuWare/Platform/Account/LogOnGuest?model={model}
/DocuWare/Platform/Account/LogOnNTLM?redirect={redirect}
/DocuWare/Platform/Account/LogOnNTLM?model={model}
/DocuWare/Platform/Account/PermanentUrl?clientSideChecksum={clientSideChecksum}
/DocuWare/Platform/Account/PermanentUrl?url={url}&ignoreMe={ignoreMe}&clientSideChecksum={clientSideChecksum}
/DocuWare/Platform/Account/Register
/DocuWare/Platform/Account/Register?model={model}
/DocuWare/Platform/Account/ResetPassword
/DocuWare/Platform/Account/ResetPassword?model={model}
/DocuWare/Platform/Account/ResetPasswordSuccess
/DocuWare/Platform/Account/TestUser
/DocuWare/Platform/Account/TokenChangePassword?token={token}
/DocuWare/Platform/Account/TokenChangePassword?model={model}
/DocuWare/Platform/Account/TokenLogOn?token={token}&returnUrl={returnUrl}&rememberMe={rememberMe}&licenseType={licenseType}
/DocuWare/Platform/Account/TokenLogOn?model={model}&returnUrl={returnUrl}
/DocuWare/Platform/Account/TrustedLogOn?returnUrl={returnUrl}
/DocuWare/Platform/Account/TrustedLogOn?model={model}
/DocuWare/Platform/Bpw?orgId={orgId}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/Bpw/CreateSimpleWorkflow?orgId={orgId}&fcGuid={fcGuid}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows/FinishSimpleWorkflow?orgID={orgID}&workflowId={workflowId}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows/GetSingleWorkflow?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows/GetWorkflows?orgID={orgID}&start={start}&count={count}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows/GetWorkflows?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/OwnSimpleWorkflows/Self?orgID={orgID}&workflowId={workflowId}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/Confirm?orgID={orgID}&taskId={taskId}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/GetSingleTask?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/GetTasks?orgID={orgID}&start={start}&count={count}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/GetTasks?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/History/{id}?orgID={orgID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/MarkAsRead?orgID={orgID}&taskID={taskID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/SimpleTasks/Self?orgID={orgID}&taskId={taskId}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/Tasks?orgID={orgID}&workflowID={workflowID}&roleType={roleType}&start={start}&count={count}
/DocuWare/Platform/Bpw/Tasks?orgID={orgID}&workflowID={workflowID}&roleType={roleType}
/DocuWare/Platform/Bpw/Tasks/CompositeData?orgID={orgID}&taskID={taskID}&roleType={roleType}
/DocuWare/Platform/Bpw/Tasks/ConfirmDecision?orgId={orgId}&taskID={taskID}&decisionId={decisionId}&roleType={roleType}&activityType={activityType}
/DocuWare/Platform/Bpw/Tasks/DecisionStamp?orgID={orgID}&taskID={taskID}&roleType={roleType}&instanceId={instanceId}
/DocuWare/Platform/Bpw/Tasks/DocumentRights?orgID={orgID}&dwVerID={dwVerID}
/DocuWare/Platform/Bpw/Tasks/History?orgID={orgID}&instanceID={instanceID}
/DocuWare/Platform/Bpw/Tasks/Lock?orgID={orgID}&instanceId={instanceId}&roleType={roleType}
/DocuWare/Platform/Bpw/Tasks/MarkAsRead?orgID={orgID}&workflowId={workflowId}&taskID={taskID}&roleType={roleType}
/DocuWare/Platform/Bpw/Tasks/Reassign?orgID={orgID}&taskID={taskID}&roleType={roleType}
/DocuWare/Platform/Bpw/Tasks/SelectList?orgId={orgId}&fieldType={fieldType}&filterGuid={filterGuid}&selectListGuid={selectListGuid}&additionalParameter={additionalParameter}&fieldName={fieldName}
/DocuWare/Platform/Bpw/Tasks/Stop?orgID={orgID}&instanceID={instanceID}
/DocuWare/Platform/Bpw/UserWorkflows?orgID={orgID}&roleType={roleType}
/DocuWare/Platform/Bpw/UserWorkflows/GetSingleTaskInformation?orgID={orgID}
/DocuWare/Platform/Bpw/Workflows?orgID={orgID}&roleType={roleType}
/DocuWare/Platform/Bpw/Workflows/DocumentHistory?orgID={orgID}&fileCabinetID={fileCabinetID}&dwVerID={dwVerID}&cancellationToken={cancellationToken}
/DocuWare/Platform/Bpw/Workflows/GetSpecificWorkflow?orgID={orgID}&roleType={roleType}
/DocuWare/Platform/Bpw/WorkflowSettings?orgID={orgID}
/DocuWare/Platform/Bpw/WorkflowSettings/GetSubstitutionLists?orgID={orgID}
/DocuWare/Platform/Bpw/WorkflowSettings/GetSubstitutionRules?orgID={orgID}&subsListGuid={subsListGuid}
/DocuWare/Platform/Bundle/{id}
/DocuWare/Platform/DeepZoom?uri={uri}
/DocuWare/Platform/EmbeddedContent/{path}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Archiving/ArchiveDocument?id={id}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Archiving/ImportDocument
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Archiving/Index?q={q}&fields={fields}&sortOrder={sortOrder}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Dialogs/{id}?dialogType={dialogType}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Dialogs/{id}/BatchUpdateFields?fields={fields}&sortOrder={sortOrder}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Dialogs/{id}/CreateUserDefinedSearch

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents?q={q}&fields={fields}&sortOrder={sortOrder}&start={start}&msStart={msStart}&count={count}&format={format}&includeSuggestions={includeSuggestions}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents?processTextshot={processTextshot}&imageProcessing={imageProcessing}&redirect={redirect}&storeDialogId={storeDialogId}&checkFileNameForCheckinInfo={checkFileNameForCheckinInfo}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Annotation
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/CheckInFromFileSystem
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/CheckoutDocument
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/CheckOutToFileSystem
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/ChecksumStatus
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Data?append={append}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Data
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/DocumentApplicationProperties
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/DocumentLinks
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Fields
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/FileDownload
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/FileDownload?targetFileType={targetFileType}&keepAnnotations={keepAnnotations}&downloadFile={downloadFile}&autoPrint={autoPrint}&layers={layers}&append={append}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/LatestVersion
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Lock
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Positions?q={q}&wholeWord={wholeWord}&ignoreCase={ignoreCase}&startSectionNumber={startSectionNumber}&startPage={startPage}&pageCount={pageCount}&rangeSearch={rangeSearch}&backward={backward}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Positions
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Rights
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/Suggestions?normalizeCoordinates={normalizeCoordinates}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/TextAnnotation?ignoreMe={ignoreMe}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/TextAnnotation
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Documents/{id}/XmlDSigContent?verify={verify}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/DocumentData?docId={docId}&sectionId={sectionId}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/ResultList?q={q}&fields={fields}&sortOrder={sortOrder}&rows={rows}&page={page}&sidx={sidx}&sord={sord}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/ResultListFromDialog?dialogId={dialogId}&query={query}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/html/ResultListFromDialog?dialogId={dialogId}&queryExpression={queryExpression}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/BatchDocumentsUpdateFields
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/BatchQueryUpdateFields?fields={fields}&sortOrder={sortOrder}&q={q}&start={start}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/ClippedDocuments?docId={docId}&operation={operation}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/ContentDivide?docId={docId}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/ContentMerge
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/CreateUserDefinedSearch?q={q}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/ProcessDocumentAction?docId={docId}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/RetrieveSequenceElement
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Operations/Unclip?docId={docId}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/CountExpression?dialogId={dialogId}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/CountExpression?dialogId={dialogId}&fieldName={fieldName}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/DialogExpression?dialogId={dialogId}&fields={fields}&sortOrder={sortOrder}&start={start}&count={count}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/DialogExpression?dialogId={dialogId}&fields={fields}&sortOrder={sortOrder}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/DialogExpressionLink?dialogId={dialogId}&fields={fields}&sortOrder={sortOrder}&start={start}&count={count}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/Documents?q={q}&fields={fields}&sortOrder={sortOrder}&start={start}&count={count}&format={format}&additionalCabinets={additionalCabinets}&includeSuggestions={includeSuggestions}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/FieldValueStatistics
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/Notifications?timeout={timeout}&notification={notification}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/OpenSearchDescription
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/SelectListExpression?dialogId={dialogId}&fieldName={fieldName}&prefix={prefix}&q={q}&sortDirection={sortDirection}&start={start}&count={count}&typed={typed}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Query/SelectListExpression?dialogId={dialogId}&fieldName={fieldName}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Rendering/{id}/Image?page={page}&format={format}&size={size}&annotations={annotations}&quality={quality}&inverted={inverted}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Rendering/{id}/Pages/{page}/{param}/dz.dzi
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Rendering/{id}/Pages/{page}/{param}/dz_files/{level}/{column}_{row}.{ext}?inverted={inverted}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Rendering/{id}/Thumbnail?page={page}&size={size}&annotations={annotations}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Replication/ReplicationCabinetInfo
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Replication/ReplicationData
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Replication/ReplicationData?additionalFields={additionalFields}&startAfterDocGuid={startAfterDocGuid}&pageSize={pageSize}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Replication/ReplicationDeleteData
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Replication/SetupReplication

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections?docid={docid}&fileName={fileName}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections?docid={docid}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}?embedThumbnailData={embedThumbnailData}&thumbnailSize={thumbnailSize}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Annotation?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/AnnotationAsImage?page={page}&format={format}&flags={flags}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Data?documentInfoInFileName={documentInfoInFileName}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Data?fileName={fileName}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/FileDownload
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/FileDownload?targetFileType={targetFileType}&keepAnnotations={keepAnnotations}&downloadFile={downloadFile}&autoPrint={autoPrint}&layers={layers}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/FileDownloadPage?page={page}&keepAnnotations={keepAnnotations}&downloadFile={downloadFile}&autoPrint={autoPrint}&layers={layers}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/FileDownloadPage?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Page?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/PagesBlock?start={start}&count={count}&embedThumbnailData={embedThumbnailData}&thumbnailSize={thumbnailSize}&thumbnailsOnly={thumbnailsOnly}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/PagesBlockResult
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Positions?q={q}&wholeWord={wholeWord}&ignoreCase={ignoreCase}&startSectionNumber={startSectionNumber}&startPage={startPage}&pageCount={pageCount}&rangeSearch={rangeSearch}&backward={backward}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Positions
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Stamp?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/StampBestPosition?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/TextAnnotation?ignoreMe={ignoreMe}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/TextAnnotation
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Textshot
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/Textshot?ignoreMe={ignoreMe}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/TextshotPage?page={page}&flat={flat}&normalize={normalize}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/TextshotPage?page={page}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Sections/{id}/TextshotXslt?page={page}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Stamps?stampType={stampType}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Stamps/{id}/AsImage?dpi={dpi}&xmlImageFormat={xmlImageFormat}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Stamps/{id}/AsImageForm?xmlImageFormat={xmlImageFormat}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Stamps/{id}/SimpleSelectList?stampFieldName={stampFieldName}&prefix={prefix}
/DocuWare/Platform/FileCabinets/{fileCabinetId}/Stamps/{id}/SimpleSelectList?stampFieldName={stampFieldName}

/DocuWare/Platform/FileCabinets/{fileCabinetId}/Task/Transfer?storeDialogId={storeDialogId}

/DocuWare/Platform/Home/About
/DocuWare/Platform/Home/CFS
/DocuWare/Platform/Home/ClientSetupInfo?orgId={orgId}&baseAddress={baseAddress}&clientSetupVersion={clientSetupVersion}
/DocuWare/Platform/Home/DownloadClientSetup?baseAddress={baseAddress}&orgId={orgId}
/DocuWare/Platform/Home/LogMessages?start={start}&count={count}&level={level}&groupId={groupId}&group={group}
/DocuWare/Platform/Home/ReflectDialogQuery
/DocuWare/Platform/Home/ReflectStampPlacement
/DocuWare/Platform/Home/ServiceDescriptionRedirect
/DocuWare/Platform/Home/Templates?format={format}
/DocuWare/Platform/Home/Token
/DocuWare/Platform/Home/TypeDescription?type={type}
/DocuWare/Platform/Home/UriTemplateHierarchy
/DocuWare/Platform/Home/UriTemplatesDocumentation
/DocuWare/Platform/Home/XSL

/DocuWare/Platform/HtmlClient/Html

/DocuWare/Platform/Lda/Auth/Token?model={model}

/DocuWare/Platform/Localization/{id}

/DocuWare/Platform/LoginRedirect?returnUrl={returnUrl}

/DocuWare/Platform/Organizations?name={name}
/DocuWare/Platform/Organizations/{id}/LoginToken
/DocuWare/Platform/Organizations/{id}/SingleColumnSelectListValuesResult?selectListId={selectListId}&start={start}&count={count}
/DocuWare/Platform/Organizations/{id}/UserGroups?userId={userId}&ignoreIt={ignoreIt}
/DocuWare/Platform/Organizations/{id}/UserRoles?userId={userId}&ignoreIt={ignoreIt}
/DocuWare/Platform/Organizations/{id}/ValidateUser
/DocuWare/Platform/Organizations/{id}/WebSettings

/DocuWare/Platform/WebClient?orgId={orgId}&openInNewWindow={openInNewWindow}&culture={culture}&passwordChanged={passwordChanged}
/DocuWare/Platform/WebClient/{orgId}/Integration?ntlmLogin={ntlmLogin}

/DocuWare/Platform/WebClient/Client/AllInOne?orgId={orgId}
/DocuWare/Platform/WebClient/Client/Basket?basketId={basketId}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/CompleteQuery
/DocuWare/Platform/WebClient/Client/Convert
/DocuWare/Platform/WebClient/Client/DocLinks?did={did}&fc={fc}&linkId={linkId}&orgId={orgId}&culture={culture}
/DocuWare/Platform/WebClient/Client/Document?did={did}&rl={rl}&fc={fc}&q={q}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/FileDownload?did={did}&rl={rl}&fc={fc}&q={q}&dt={dt}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/GetOrganization?orgs={orgs}
/DocuWare/Platform/WebClient/Client/History?did={did}&fc={fc}&culture={culture}&displayOneDoc={displayOneDoc}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/Indexes?rl={rl}&fc={fc}&did={did}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/Result?did={did}&rl={rl}&fc={fc}&sed={sed}&q={q}&culture={culture}&tw={tw}&displayOneDoc={displayOneDoc}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/Search?sed={sed}&dv={dv}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/Separate?orgId={orgId}
/DocuWare/Platform/WebClient/Client/Store?dlgID={dlgID}&fc={fc}&culture={culture}&orgId={orgId}&validateMandatoryFields={validateMandatoryFields}
/DocuWare/Platform/WebClient/Client/StoreView?targetCabinetId={targetCabinetId}&storeDlgId={storeDlgId}&sourceCabinetId={sourceCabinetId}&docIdValues={docIdValues}&waitForDocContent={waitForDocContent}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/SWOwner?instanceId={instanceId}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/SWTask?taskId={taskId}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/TestViewer?orgId={orgId}
/DocuWare/Platform/WebClient/Client/UI?orgId={orgId}
/DocuWare/Platform/WebClient/Client/Viewer?orgId={orgId}
/DocuWare/Platform/WebClient/Client/WFTask?workflowId={workflowId}&instanceId={instanceId}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/Client/WFTaskList?workflowId={workflowId}&roleType={roleType}&culture={culture}&orgId={orgId}
/DocuWare/Platform/WebClient/ClientAccount
/DocuWare/Platform/WebClient/ClientAccount/ChangeLanguage?lang={lang}&returnUrl={returnUrl}
/DocuWare/Platform/WebClient/ClientAccount/ChangePassword?UserName={UserName}&Organization={Organization}&ShowUsernameField={ShowUsernameField}&loginFailed={loginFailed}
/DocuWare/Platform/WebClient/ClientAccount/ChangePassword?model={model}
/DocuWare/Platform/WebClient/ClientAccount/Disconnect
/DocuWare/Platform/WebClient/ClientAccount/LogIn?loginModel={loginModel}&isIntegrationLink={isIntegrationLink}
/DocuWare/Platform/WebClient/ClientAccount/LogIn?model={model}
/DocuWare/Platform/WebClient/ClientAccount/LogInNtlm?model={model}
/DocuWare/Platform/WebClient/ClientAccount/LogInNtlm/{autoLogin}?orgId={orgId}
/DocuWare/Platform/WebClient/ClientAccount/LogOff?openedInSeparateWindow={openedInSeparateWindow}
/DocuWare/Platform/WebClient/ClientAccount/ResetPassword?userName={userName}&organization={organization}
/DocuWare/Platform/WebClient/ClientAccount/TokenChangePassword?token={token}&password={password}
/DocuWare/Platform/WebClient/Forms/Administration/CopyTemplate
/DocuWare/Platform/WebClient/Forms/Administration/DeleteTemplates
/DocuWare/Platform/WebClient/Forms/Administration/ExportConfig
/DocuWare/Platform/WebClient/Forms/Administration/ExportTemplate
/DocuWare/Platform/WebClient/Forms/Administration/FormSubmitted?message={message}
/DocuWare/Platform/WebClient/Forms/Administration/GetTemplateImage
/DocuWare/Platform/WebClient/Forms/Administration/ImportConfig
/DocuWare/Platform/WebClient/Forms/Administration/ImportTemplate
/DocuWare/Platform/WebClient/Forms/Administration/Index?formName={formName}&orgID={orgID}
/DocuWare/Platform/WebClient/Forms/Administration/SaveTemplate
/DocuWare/Platform/WebClient/Forms/Administration/Submit?orgID={orgID}
/DocuWare/Platform/WebClient/Forms/Administration/UploadTemplate
/DocuWare/Platform/WebClient/Viewer
/DocuWare/Platform/WebClient/Viewer/DocumentData?fileCabinetId={fileCabinetId}&docId={docId}&sectionId={sectionId}&page={page}&includeDocument={includeDocument}&includeSection={includeSection}&includePage={includePage}&checksum={checksum}&latestVersion={latestVersion}&withContentArea={withContentArea}
/DocuWare/Platform/WebClient/Viewer/GetDocument?fileCabinetId={fileCabinetId}&docId={docId}&sectionId={sectionId}&page={page}&checksum={checksum}&latestVersion={latestVersion}&withContentArea={withContentArea}
/DocuWare/Platform/WebClient/Viewer/GetInstalledFonts
/DocuWare/Platform/WebClient/Viewer/GetJSResources?culture={culture}
/DocuWare/Platform/WebClient/Viewer/GetPage?fileCabinetId={fileCabinetId}&docId={docId}&sectionId={sectionId}&page={page}&withContentArea={withContentArea}
/DocuWare/Platform/WebClient/Viewer/GetSection?fileCabinetId={fileCabinetId}&docId={docId}&sectionId={sectionId}&page={page}&withContentArea={withContentArea}
/DocuWare/Platform/WebClient/Viewer/LogOff
/DocuWare/Platform/WebClient/Viewer/Stamps?fileCabinetId={fileCabinetId}&stampType={stampType}
/DocuWare/Platform/WebClient/Viewer/TokenLogon?token={token}&rememberMe={rememberMe}&instanceId={instanceId}




### UNNECESSARY METHODS
-----------------------
`/DocuWare/Platform/Organizations/{id}/UserInfo`
  - Only applies to currently logged-in user
```
/DocuWare/Platform/Schema?findSchemaType={findSchemaType}&searchElement={searchElement}&jsonSchema={jsonSchema}
/DocuWare/Platform/Schema/File/{id}
/DocuWare/Platform/Schema/Search?findSchemaType={findSchemaType}
```
  - Only applicable to website platform

```
/DocuWare/Platform/Test/NastyJson
/DocuWare/Platform/Test/Notifications
/DocuWare/Platform/Test/NotificationsFC
/DocuWare/Platform/Test/NotificationsTest
```
  - Test methods

### APPARENTLY BROKEN METHODS
-----------------------------
`/DocuWare/Platform/Users?orgid={orgid}` *GET*
